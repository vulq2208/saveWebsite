        // $categories = Category::where('parent_id', '=', $categoriesId->id)
        // ->orWhere(function($query) use ($categoriesId) {
        //       $query->where('id', '=', $categoriesId->parent_id)
        //             ->where('parent_id', '=', $categoriesId->parent_id);
        // })->get();
        // if($categoriesId) {
        //     $categories = Category::where('parent_id','=',$categoriesId)->first();
        // dd($categories);

        // }


        // $categoriesId = Category::where('slug','=',$slug)->first();
        // $categoriesIds = [$categoriesId->id];
        // $nextCategory = $categoriesId;
        // while ($nextCategory->parent_id) {
        //     $nextCategory = Category::find($nextCategory->parent_id);
        //     $categoriesIds[] = $nextCategory->id;
        // }
        // $categories = Category::whereIn('id', $categoriesIds)->get();
