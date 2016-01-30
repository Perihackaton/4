package com.natateam.myzkh.net;

import org.json.JSONException;

/**
 * Created by macbook on 31/01/ 15.
 */
public class AddBillRequest extends BaseRequest {
    public static final String API="add_bill_for_user/";
    public AddBillRequest(String bill,int service_id, Listener listener) {
        super(Method.POST, API, listener);
        addParam("bill", bill);
        addParam("service_id",service_id);
    }

    @Override
    protected void parseResponse() throws JSONException {
        notifySuccess();
    }
}
