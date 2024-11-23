<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\PersonalInfoRequest;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use Storage;

class PersonalInfoController extends Controller
{

    /**
     * Show the form for editing the account infomation
     */
    public function edit()
    {
        $genders = CustomerInfo::getEnumGenders();
        return view('client.account-setting-partials.account-info', compact('genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonalInfoRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('cus_avt')) {
            $file = $request->file('cus_avt');
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $fileName, 'upload');
            $oldAvt = $request->user()->customerInfo->cus_avt;
            if ($oldAvt) {
                Storage::disk('upload')->delete($oldAvt);
            }
            $validatedData['cus_avt'] = $path;
        }
        $request->user()->customerInfo->update($validatedData);
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
