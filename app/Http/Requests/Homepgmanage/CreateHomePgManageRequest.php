<?php

namespace App\Http\Requests\Homepgmanage;

use App\Model\HomePageManagement;
use App\Model\HomePgItem;
use Illuminate\Foundation\Http\FormRequest;

class CreateHomePgManageRequest extends FormRequest
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
    public function handle(){
        $this->validated();

        $params = $this->all();
        $players = $params['players'];
        $clubs = $params['clubs'];
        $videos = $params['videos'];

        $homepgsection = new HomePageManagement();

        $homepgsection->name = $params['name'];
        $homepgsection->status = isset($params['status']) ? 1 : 0;

        $homepgsection->save();

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
