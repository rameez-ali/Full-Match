<?php

namespace App\Http\Requests\Dashboard;

use App\customer;
use App\Model\Club;
use App\Model\Order;
use App\Model\Player;
use App\Model\Category;
use App\Model\Video;
use App\Model\Video_genre;
use Illuminate\Foundation\Http\FormRequest;

class GetDashboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
    public function handle()
    {
          $all_customers = Customer::select('customers.id','customers.name','users.phone','customers.email','customers.user_id')
            ->join('users','customers.user_id' , '=' ,'users.id')
            ->where('users.deleted_at',null)
            ->get()->count();

          $sold_plans = Order::where('payment_status' , 'Captured')->get()->count();

          $all_videos = Video::get()->count();

          $all_categories = Category::get()->count();

          $all_video_genres = Video_genre::get()->count();

          $all_clubs = Club::get()->count();

          $all_players = Player::get()->count();



        return [
            'all_customers' => $all_customers,
            'sold_plans' => $sold_plans,
            'all_videos' => $all_videos,
            'all_categories' => $all_categories,
            'all_video_genres' => $all_video_genres,
            'all_clubs' => $all_clubs,
            'all_players' => $all_players,
            ];

    }
}
