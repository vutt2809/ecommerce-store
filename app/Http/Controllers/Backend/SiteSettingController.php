<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seos;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function siteSetting() {
        $setting = SiteSetting::find(1);

        return view('backend.setting.site_setting', compact('setting'));
    }

    public function updateSiteSetting(Request $request) {
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
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $save_url,
                'updated_at' => Carbon::now()
            ]);

        } else {
            SiteSetting::findOrFail($settingId)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = [
            'alert-type' => 'success',
            'message' => 'Site setting has been updated sucessfully!',
        ];

        return redirect()->back()->with($notification);
    }

    public function seoSetting() {
        $seo = Seos::find(1);
        return view('backend.setting.seo_setting', compact('seo'));
    }

    public function updateSeoSetting(Request $request) {
        $seoId = $request->id;

        Seos::findOrFail($seoId)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Seo setting has been updated successfully!'
        ];

        return redirect()->back()->with($notification);
    }
}
