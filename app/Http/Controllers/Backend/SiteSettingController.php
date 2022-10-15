<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function index() {
        $setting = SiteSetting::find(1);

        return view('backend.setting.site_setting', compact('setting'));
    }

    public function update(Request $request) {
        $settingId = $request->id;

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(139,36)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;

            SiteSetting::findOrFail($settingId)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $save_url,
            ]);
        }
    }
}
