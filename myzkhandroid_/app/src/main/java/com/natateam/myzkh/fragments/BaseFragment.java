package com.natateam.myzkh.fragments;

import android.app.AlertDialog;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;

import com.androidquery.AQuery;
import com.natateam.myzkh.managers.DbManager;
import com.natateam.myzkh.screens.MainActivity;


import java.lang.reflect.Constructor;
import java.util.ArrayList;


/**
 * Created by macbook on 27/01/15.
 */
public class BaseFragment extends Fragment  {
    AQuery aQuery;
    protected DbManager dbManager;


    public static BaseFragment getInstance(final Class<?> classToCreate, final Bundle params){
        try
        {
            final Class<?>[] argTypes = {};
            final Constructor<?> constructor = classToCreate.getDeclaredConstructor(argTypes);
            final BaseFragment fragment = (BaseFragment) constructor.newInstance();
            if (params != null)
                fragment.setArguments(params);
            return fragment;
        }
        catch (Exception e)
        {
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        aQuery=new AQuery(getActivity());
        dbManager=DbManager.getInstanse();
        super.onActivityCreated(savedInstanceState);

    }



    public static void hideAllFragments(final FragmentActivity c, final ArrayList<String> fragments)
    {
        final FragmentManager fm = c.getSupportFragmentManager();
        if (fm != null)
        {
            final FragmentTransaction ft = fm.beginTransaction();

            Fragment fragment;
            for (int i = 0; i < fragments.size(); i++)
            {
                fragment = fm.findFragmentByTag(fragments.get(i));
                if (fragment != null)
                {
                    ft.hide(fragment);
                }
            }
            ft.commit();
        }
    }






    private AlertDialog.Builder alertDialogInit(String title, String message){
        AlertDialog.Builder ad = new AlertDialog.Builder(getActivity());
        ad.setTitle(title);
        ad.setMessage(message);
        ad.setCancelable(true);
        return ad;
    }




    /*private VKSdkListener vkSdkListener = new VKSdkListener() {
        @Override
        public void onCaptchaError(VKError captchaError) {
            new VKCaptchaDialog(captchaError).show();
        }

        @Override
        public void onTokenExpired(VKAccessToken expiredToken) {
            VKSdk.authorize(sMyScope);
        }

        @Override
        public void onAccessDenied(final VKError authorizationError) {;
            new AlertDialog.Builder(VKUIHelper.getTopActivity())
                    .setMessage(getResources().getString(R.string.acces_error))
                    .show();
        }

        @Override
        public void onReceiveNewToken(VKAccessToken newToken) {
            newToken.saveTokenToSharedPreferences(ChargeApp.getInstance().getApplicationContext(), sTokenKey);
            setVkData(social_type);
        }

        @Override
        public void onAcceptUserToken(VKAccessToken token) {
            token.saveTokenToSharedPreferences(ChargeApp.getInstance().getApplicationContext(), sTokenKey);
        }
    };*/





    public MainActivity getMainActivity(){
        return (MainActivity)getActivity();
    }


}
