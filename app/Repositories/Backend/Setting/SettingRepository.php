<?php

namespace App\Repositories\Backend\Setting;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Setting\Setting;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class SettingRepository.
 */
class SettingRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Setting::class;

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->first()) {
            throw new GeneralException(trans('exceptions.backend.Settings.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $Settings = self::MODEL;
            $Settings = new $Settings();
            $Settings->name = $input['name'];
            $Settings->slug = $input['slug'];
            $Settings->content = $input['content'];

            if ($Settings->save()) {

                // event(new SettingCreated($Settings));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.Settings.create_error'));
        });
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
     
    public function update(Model $Settings, array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->where('id', '!=', $Settings->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.Settings.already_exists'));
        }
        $Settings->name = $input['name'];
        $Settings->slug = $input['slug'];
        $Settings->content = $input['content'];

        DB::transaction(function () use ($Settings, $input) {
        	if ($Settings->save()) {
                // event(new SettingUpdated($Settings));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.Settings.update_error')
            );
        });
    }

    /**
     * @param Model $category
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $category)
    {
        DB::transaction(function () use ($category) {

            if ($category->delete()) {
                // event(new SettingDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.Settings.delete_error'));
        });
    }

    public function getSettingBySlug($slug)
    {
        return $this->query()->where('slug', $slug)->first();
    }
}