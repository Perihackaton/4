package com.natateam.myzkh.net;

import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.managers.DbManager;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.model.Profile;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by macbook on 31/01/ 15.
 */
public class GetProfileRequest extends BaseRequest {
    public static final String API="get_profile/";
    public GetProfileRequest(Listener listener) {
        super(Method.GET, API, listener);
    }

    @Override
    protected void parseResponse() throws JSONException {
        JSONObject jsonObject= new JSONObject(getDataString());
        Profile profile=mGson.fromJson(jsonObject.getJSONObject("profile").toString(), Profile.class);
        SharedManager.getInstase().saveProfile(profile);
        String bills=jsonObject.getJSONArray("bills").toString();
        DbManager.getInstanse().updateBills(bills);
        notifySuccess();
    }
}
