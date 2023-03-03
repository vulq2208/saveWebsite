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
        $companyLatest = Company::latest('id')->value('id');

        $createJobs = CompanyJobs::create([
            'form' => $form,
            'experience' => $experience,
            'gender' => $gender,
            'requirements' => $requirements,
            'education' => $education,
            'description' => $description,
            'company_id' => $companyLatest,
        ]);

    }

    public function extractCompany() {

        $client = new Client();
        $crawler = $client->request('GET', 'https://alojob.vn/viec-lam/can-tuyen-nhan-vien-pg-cho-cong-ty-co-phan-diligo-holdings-72556');
        $company_name = $crawler->filter('.fb-profile-text p a')->text();
        $company_status = $crawler->filter('.panel-default .form-group .text-success ')->text();
        $company_field = $crawler->filter('.panel-default .form-group span')->each(function ($node){
            return $node->text();
        })[2];

        $imageUrls = $crawler->filter('.fb-profile img')->last()->attr('src');
        $fullUrl = env('URL_WEBSITE') . $imageUrls;
        $imageContent = file_get_contents($fullUrl);
        $company_logo = Str::random(10) . '.jpg';
        $storedImage = Storage::put('images/'.$company_logo,$imageContent);

        Company::create([
            'company_name' => $company_name,
            'company_logo' => $company_logo,
            'company_status' => $company_status,
            'company_field'  => $company_field,
        ]);

        $this->info("Thành Công!");


    }


    public function extractsJobs () {
        $client = new Client();
        $crawler = $client->request('GET', 'https://alojob.vn/tim-kiem/viec-lam-phuc-vu');
        $getElementLinks = $crawler->filter('.shadow .col-md-12 .col-md-6 .cont-item  a')->each(function ($node) use ($client) {
            $url = $node->link()->getUri();
            $subCrawler = $client->request('GET', $url);

            $iframe = $subCrawler->filter('iframe')->first();
            $iframe->each(function ($iframeNode)  use ($client , $subCrawler) {
                $form = $subCrawler->filter('label:contains("Hình thức:")')->first()->nextAll()->filter('p')->first()->text();
                $requirements = $subCrawler->filter('p:contains("Yêu cầu chung:")')->first()->nextAll()->filter('p')->first()->text();
                $description = $subCrawler->filter('label:contains("Mô tả công việc:")')->first()->nextAll()->filter('p')->first()->text();
                $experience = $subCrawler->filter('span:contains("Kinh nghiệm:")')->first()->nextAll()->filter('span')->first()->text();
                $gender = $subCrawler->filter('span:contains("Giới tính: ")')->first()->nextAll()->filter('span')->first()->text();
                $education = $subCrawler->filter('span:contains("Học vấn:")')->first()->nextAll()->filter('span')->first()->text();
                $src = $iframeNode->attr('src');
                $urlIframeCompanys = Company::where('company_url_iframe',$src)->get();
                foreach ($urlIframeCompanys as $urlIframeCompany) {
                    if($urlIframeCompany->company_url_iframe == $src) {
                        $createJobs = CompanyJobs::create([
                            'form' => $form,
                            'experience' => $experience,
                            'gender' => $gender,
                            'requirements' => $requirements,
                            'education' => $education,
                            'description' => $description,
                            'company_id' => $urlIframeCompany->id,
                        ]);
                    }
                }
            });

        });
    }

    public function extractsCompany() {
        $client = new Client();
        $crawler = $client->request('GET', 'https://alojob.vn/tim-kiem/viec-lam-phuc-vu');
        $crawler->filter('.shadow .col-md-12 .col-md-6 .cont-item  a')->each(function ($node) use ($client) {
            $url = $node->link()->getUri();
            $subCrawler = $client->request('GET', $url);
            $iframe = $subCrawler->filter('iframe')->first();
            $iframe->each(function ($iframeNode)  use ($client) {
                $src = $iframeNode->attr('src');
                if ($src){
                    $crawlerCompanyList = $client->request('GET', $src);
                    $company_name = $crawlerCompanyList->filter('.fb-profile-text p a')->text();
                    $imageUrls = $crawlerCompanyList->filter('.fb-profile img')->last()->attr('src');
                    $fullUrl = env('URL_WEBSITE') . $imageUrls;
                    $imageContent = file_get_contents($fullUrl);
                    $company_logo = Str::random(10) . '.jpg';
                    $storedImage = Storage::put('images/'.$company_logo,$imageContent);
                    $company_status = $crawlerCompanyList->filter('.panel-default .form-group .text-success ')->text();
                    $company_field = $crawlerCompanyList->filter('.panel-default .form-group span')->each(function ($node){
                        return $node->text();
                    })[2];
                    $createCompany = Company::create([
                        'company_name' => $company_name,
                        'company_logo' => $company_logo,
                        'company_status' => $company_status,
                        'company_field'  => $company_field,
                        'company_url_iframe' => $src,
                    ]);
                }
            });
        });

    }

    public function handle()
    {
        // $this->extractCompany();
        // $this->extractJobs();

        $this->extractsCompany();
        $this->extractsJobs();



    }
}
