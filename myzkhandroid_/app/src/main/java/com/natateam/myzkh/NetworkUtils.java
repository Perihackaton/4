package com.natateam.myzkh;

import android.app.AlarmManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;


import java.util.Calendar;

/**
 * Created by macbook on 14/03/15.
 */
public class NetworkUtils {
    public static final int NO_CONNECT=0;
    public static final int MOBILE=1;
    public static final int WIFI=2;

    public static int isNetworkAvailableWithFi(Context context) {
        boolean isMobile = false, isWifi = false;
        NetworkInfo[] infoAvailableNetworks =
                ((ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE)).getAllNetworkInfo();
        if (infoAvailableNetworks != null) {
            for (NetworkInfo network : infoAvailableNetworks) {

                if (network.getType() == ConnectivityManager.TYPE_WIFI) {
                    if (network.isConnected() && network.isAvailable())
                        isWifi = true;
                }
                if (network.getType() == ConnectivityManager.TYPE_MOBILE) {
                    if (network.isConnected() && network.isAvailable())
                        isMobile = true;
                }
            }
            if (isWifi){
                return WIFI;
            }else return MOBILE;
        }else return NO_CONNECT;

    }

    public static boolean isNetworkAvailable(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        if (networkInfo != null && networkInfo.isConnected()) {
            return true;
        }
        return false;
    }




}
