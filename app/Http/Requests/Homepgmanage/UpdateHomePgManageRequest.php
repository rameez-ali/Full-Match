<?php

namespace App\Http\Requests\Homepgmanage;

use App\Model\HomePageManagement;
use App\Model\HomePgItem;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePgManageRequest extends FormRequest
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
            'name' => ['required', 'string'],
        ];
    }
    public function handle()
    {
        $this->validated();

        $params = $this->all();
        $leagues = $params['league'];
        $players = $params['players'];
        $clubs = $params['clubs'];
        $videos = $params['videos'];

//        $forhomepgstatus = HomePageManagement::where('status' , 1)->first();
//
//        if (isset($params['status']) && $forhomepgstatus->id != $this->id ){
//            return false;
//        }
        $homepgsection = HomePageManagement::find($this->id);

        $homepgsection->name = $params['name'];
        $homepgsection->status = isset($params['status']) ? 1 : 0;

        $homepgsection->save();

       HomePgItem::where('section_id',$this->id)->forceDelete();

        foreach ($leagues as $league ){
            $data = array(
                'section_id'     =>   $homepgsection->id,
                'item_name'     =>  'league',
                'item_id'     =>  $league,
            );
            HomePgItem::create($data);
        }

        foreach ($players as $player ){
            $data = array(
                'section_id'     =>   $homepgsection->id,
                'item_name'     =>  'players',
                'item_id'     =>  $player,
            );
            HomePgItem::create($data);
        }
        foreach ($clubs as $club ){
            $data = array(
                'section_id'     =>   $homepgsection->id,
                'item_name'     =>  'clubs',
                'item_id'     =>  $club,
            );
            HomePgItem::create($data);
        }
        foreach ($videos as $video ){
            $data = array(
                'section_id'     =>   $homepgsection->id,
                'item_name'     =>  'videos',
                'item_id'     =>  $video,
            );
            HomePgItem::create($data);
        }

        return true;
    }
}
