package com.natateam.myzkh.net;

import android.content.Context;
import android.content.Intent;
import android.support.v4.content.LocalBroadcastManager;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.HttpHeaderParser;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.natateam.myzkh.R;
import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.managers.SharedManager;


import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.lang.reflect.Modifier;
import java.util.HashMap;
import java.util.Map;





public abstract class BaseRequest extends Request<String> {

    public final static String REQUEST_ERROR = "REQUEST_ERROR";
    public final static String REQUEST_DATA = "REQUEST_DATA";
    public final static String TOKEN_NOT_FOUND="TOKEN_NOT_FOUND";
    public final static String TIME_OUT_ERROR="TIME_OUT_ERROR";
    public final static String SUCCES_REQUEST="SUCCES_REQUEST";
    protected final static String SERVER_URL = "http://prj2.magic-egg.net/api/";
    private Map<String, String> mParams;
    private Map<String, String> mHeaders;
    protected Gson mGson;
    private String mApiMethod;
    private Status mStatus;
    public Status getStatus() {
        return mStatus;
    }

    private String mData;

    public String getDataString() {
        return mData;
    }

    public String getApiMethod() {
        return mApiMethod;
    }

    protected Listener mListener;

    protected Error mError;

    public Error getError() {
        return mError;
    }

    public BaseRequest(int method, String apiMethod, Listener listener) {
        super(method, ZkhApp.getInstanse().getString(R.string.api_host) + apiMethod, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError volleyError) {
                Intent intent = new Intent(REQUEST_ERROR);
                intent.putExtra("data", volleyError.toString());
            }
        });
        this.setRetryPolicy(new DefaultRetryPolicy(
                30000,
                DefaultRetryPolicy.DEFAULT_MAX_RETRIES,
                DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));
        mParams = new HashMap<String, String>();
        mHeaders= new HashMap<String,String>();
        mGson = new GsonBuilder().create();
        mApiMethod = apiMethod;
        mListener = listener;
    }

    protected Context getContext() {
        return ZkhApp.getInstanse().getApplicationContext();
    }

    @Override
    public void deliverError(VolleyError error) {
        super.deliverError(error);
        if (error != null) {
            notifyFailure(new Error(error.getMessage(), -1));
        } else {
            notifyFailure(new Error("Неизвестная ошибка", -1));
        }
    }

    @Override
    protected Response<String> parseNetworkResponse(NetworkResponse response) {
        String parsed;
        try {
            parsed = new String(response.data, HttpHeaderParser.parseCharset(response.headers));
        } catch (UnsupportedEncodingException e) {
            parsed = new String(response.data);
        }
        return Response.success(parsed, HttpHeaderParser.parseCacheHeaders(response));
    }

    @Override
    protected void deliverResponse(String response)  {
        try {
            JSONObject jsonObject = new JSONObject(response);
            mStatus = mGson.fromJson(jsonObject.getString("status"), Status.class);
            if (mStatus.code != Status.OK) {
                mError=new Error(mStatus.message,mStatus.code);
                requestFailure(mError);
                return;
            }
            mError = new com.natateam.myzkh.net.Error("", 0);
            try {
                mData = jsonObject.getString("data");
            } catch (JSONException ex) {
                ex.printStackTrace();
            } finally {
                parseResponse();
            }
        } catch (JSONException ex) {
            ex.printStackTrace();
            requestFailure(null);
        }
    }
    public void errorAction(int errorCode){
        switch (errorCode){
            case Error.TOKEN_NOT_FOUND:{
                Intent intent= new Intent(BaseRequest.TOKEN_NOT_FOUND);
                LocalBroadcastManager.getInstance(getContext()).sendBroadcast(intent);
            }
        }

    }

    @Override
    protected Map<String, String> getParams() throws AuthFailureError {
        return mParams;
    }

    @Override
    public String getUrl() {
        if (this.getMethod() == Method.GET) {
            try {
                String url = super.getUrl();
                for (String key : getParams().keySet()) {
                    url = url + key + "=" + getParams().get(key) + "&";
                }
                return url;
            } catch (AuthFailureError ex) {
                ex.printStackTrace();
            }
        }
        return super.getUrl();
    }

    protected abstract void parseResponse() throws JSONException;

    protected void requestFailure(Error error) {
        notifyFailure(error);
    }

    protected void notifySuccess() {
        if (mListener != null) {
            mListener.onResponse(this);
        }
    }

    protected void notifyFailure(Error error) {
        mError = error;
        if (mError!=null&&mError.message!=null){
            if (mError.message.indexOf("java")!=-1){
                ZkhApp.getInstanse().showToast(getContext().getString(R.string.check_internet_toast));
            }else {
                if (mError.code==402){
                    LocalBroadcastManager.getInstance(getContext()).sendBroadcast(new Intent(TOKEN_NOT_FOUND));
                    SharedManager.getInstase().setToken(null);
                }
                ZkhApp.getInstanse().showToast(mError.message);
            }
        }else {
            ZkhApp.getInstanse().showToast(getContext().getString(R.string.error_string));
        }
        if (mListener != null) {
            mListener.onError(error, this);
        }
    }
    public void sentError() {
        if (this.mError == null) {
            sentSucces();
        } else {
            try {
                if (!this.mError.message.contains("java")) {
                    sentSucces();
                } else {
                    Intent intent = new Intent(TIME_OUT_ERROR);
                    LocalBroadcastManager.getInstance(getContext()).sendBroadcast(intent);
                }
            } catch (Exception ex) {

                 ex.printStackTrace();
            }
        }
    }
    public void sentSucces(){
        Intent intent= new Intent(SUCCES_REQUEST);
        LocalBroadcastManager.getInstance(getContext()).sendBroadcast(intent);
    }


    protected void addParam(String name, Object value) {
        mParams.put(name, String.valueOf(value));
    }

    /**
     * Метод для тестов api без запроса к серверу
     */
    public void execute() {
    }


    @Override
    public Map<String, String> getHeaders() throws AuthFailureError {
        if ( SharedManager.getInstase().getTOKEN()!=null) {
            mHeaders.put("Token", SharedManager.getInstase().getTOKEN());
        }
        return mHeaders;
    }
}
