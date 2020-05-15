<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Category_gender;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header', function ($view){
           $category_gender = Category_gender::all();
            $menus_men = category::with('childs')
//                ->where('parent_id', '=', 0)
//                ->where('category_gender_id', '=', 1)
                    ->where([
                        ['parent_id','=',0],
                        ['category_gender_id','=',1]
                ])
                ->get();

            $menus_women = category::with('childs')
//                ->where('parent_id', '=', 0)
//                ->where('category_gender_id', '=', 2)
                ->where([
                    ['parent_id','=',0],
                    ['category_gender_id','=',2]
                ])
                ->get();
            return $view->with(compact('category_gender','menus_men','menus_women'));
        });
    }
}
