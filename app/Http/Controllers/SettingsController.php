<?php

namespace App\Http\Controllers;

use App\Models\MailSetting;
use Illuminate\Http\Request;
use App\Models\StripeSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MailSettingFormRequest;
use App\Http\Requests\StripeSettingFormRequest;
use Illuminate\Support\Facades\Gate;

class SettingsController extends Controller
{

    public function mailSettings()
    {
        Gate::authorize('view-any', MailSetting::class);

        $mail_settings = MailSetting::first();

        return view('admin.settings.mail.index', compact('mail_settings'));
    }


    public function createOrUpdateMailSettings(MailSettingFormRequest $request)
    {
        Gate::authorize('create-or-update', MailSetting::class);

        DB::beginTransaction();

        try {
            $mail_settings = MailSetting::first() ?? new MailSetting;

            $mail_settings->mail_transport = $request->mail_transport;
            $mail_settings->mail_host = $request->mail_host;
            $mail_settings->mail_port = $request->mail_port;
            $mail_settings->mail_encryption = $request->mail_encryption;
            $mail_settings->mail_username = $request->mail_username;
            $mail_settings->mail_password = $request->mail_password;
            $mail_settings->mail_from_address = $request->mail_from_address;
            $mail_settings->mail_from_name = $request->mail_from_name;
            $mail_settings->save();
            
            return redirect()->back()->with(['success'=>'Updated successfully!']);

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error'=>'Something went wrong!'])->withInput();
        }
    }

    
}
