package com.natateam.myzkh.net;

import com.google.gson.reflect.TypeToken;
import com.natateam.myzkh.dbmodel.BillHistoryItem;
import com.natateam.myzkh.managers.DbManager;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by macbook on 31/01/ 15.
 */
public class GetHistoryRequest extends BaseRequest {
    public static final String API="get_history_for_service/";
    private String bill;
    public GetHistoryRequest(int service_id, String bill, Listener listener) {
        super(Method.POST, API, listener);
        addParam("service_id", service_id);
        addParam("bill",bill);
        this.bill=bill;
    }

    @Override
    protected void parseResponse() throws JSONException {
        JSONObject jsonObject= new JSONObject(getDataString());
        String history=jsonObject.getJSONArray("history").toString();
        /*ArrayList<BillHistoryItem> historyItems
                =mGson.fromJson(history,new TypeToken<ArrayList<BillHistoryItem>>(){}.getType());*/
        DbManager.getInstanse().updateHistory(history, bill);

        notifySuccess();

    }
}
