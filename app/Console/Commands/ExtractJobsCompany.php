<?php

namespace App\Console\Commands;

use DB;
use Goutte\Client;
use Illuminate\Http\File;
use App\Models\CompanyJobs;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class ExtractJobsCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:JobsCompany';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function extractJobs() {

        $client = new Client();
        $crawler = $client->request('GET', 'https://alojob.vn/viec-lam/can-tuyen-nhan-vien-pg-cho-cong-ty-co-phan-diligo-holdings-72556');
        $textP = $crawler->filter('.tab-content .tab-pane .col-md-12 .form-group p')->each(function ($node){
            return $node->text();
        });
        $textSpan = $crawler->filter('.tab-content .tab-pane .col-md-12 .form-group .col-md-9 p span')->each(function ($node){
            return $node->text();
        });
        $form =  $textP[0];
        $requirements = $textP[9];
        $description = $textP[10];
        $experience = $textSpan[5];
        $gender = $textSpan[1];
        $education = $textSpan[7];
        $companyFirst = Company::first();

        $createJobs = CompanyJobs::create([
            'form' => $form,
            'experience' => $experience,
            'gender' => $gender,
            'requirements' => $requirements,
            'education' => $education,
            'description' => $description,
            'company_id' => $companyFirst->id,
        ]);

    }

    public function extractCompany() {

        $client = new Client();
        $crawler = $client->request('GET', 'https://alojob.vn/viec-lam/can-tuyen-nhan-vien-pg-cho-cong-ty-co-phan-diligo-holdings-72556');
        $iframe = $crawler->filter('iframe')->first();
        $iframeSrc = $iframe->extract(['src'])[0];
        $crawler = $client->request('GET', $iframeSrc);
        $company_name = $crawler->filter('.fb-profile-text p a')->text();

        $imageUrls = $crawler->filter('.fb-profile img')->last()->attr('src');
        $fullUrl = env('URL_WEBSITE') . $imageUrls;

        $imageContent = file_get_contents($fullUrl);
        $image = imagecreatefromstring($imageContent);
        $company_logo = Str::random(10) . '.jpg';
        $imagePath = public_path('images/' . $company_logo);
        imagejpeg($image, $imagePath);

        $company_status = $crawler->filter('.panel-default .form-group .text-success ')->text();
        $company_field = $crawler->filter('.panel-default .form-group span')->each(function ($node){
            return $node->text();
        })[2];

        $createCompany = Company::create([
            'company_name' => $company_name,
            'company_logo' => $company_logo,
            'company_status' => $company_status,
            'company_field'  => $company_field,
        ]);

        if(!empty($createCompany)) {
        $this->info("Thành Công!");
         }



    }

    public function handle()
    {
        $this->extractCompany();
        $this->extractJobs();


    }
}
