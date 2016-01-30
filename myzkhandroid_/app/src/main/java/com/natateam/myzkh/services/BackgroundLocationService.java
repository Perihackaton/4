package com.natateam.myzkh.services;

import android.app.Activity;
import android.app.Service;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
import android.os.IBinder;
import android.support.v4.content.ContextCompat;
import android.support.v4.content.LocalBroadcastManager;
import android.util.Log;

import com.natateam.myzkh.ZkhApp;

import java.util.ArrayList;
import java.util.Timer;



public class BackgroundLocationService extends Service implements android.location.LocationListener{

    public static final String INTENT_COMMAND = "command";
    public static final String INTENT_COMMAND_START = "start";
    public static final String INTENT_IS_FAST = "INTENT_IS_FAST";
    public static final String INTENT_COMMAND_STOP = "stop";
    // GPS variables
    private static final String TAG = "BackgroundLocationService";
    boolean isGPSEnabled = false;
    boolean isNetworkEnabled = false;
    public static int id = -1;
    boolean canGetLocation = false;
    Location location; // location
    double latitude; // latitude
    double longitude; // longitude
    private static final long MIN_DISTANCE_CHANGE_FOR_UPDATES = 1000; // 10 meters
    private static final long MIN_TIME_BW_UPDATES = 1000; //1sec         //1000 * 60 * 1; // 1 minute
    // Declaring a Location Manager
    protected LocationManager locationManager;

    private ArrayList<Integer> availableObject= new ArrayList<Integer>();
    private boolean isNeedFastRequest;
    private float minDistance=0;
    private Timer timer;


    @Override
    public void onCreate() {
        super.onCreate();

        //availableObject = availableLabrisObjectRoadDAO.getAll(this);
        latitude = 50;
        longitude = 50;
        //startFetcging();

     //   location.setLatitude(latitude);
     //   location.setLongitude(longitude);

    }

    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        super.onStartCommand(intent, flags, startId);
        if (intent!=null) {
            Bundle bundle = intent.getExtras();
            String command = bundle.getString(INTENT_COMMAND);
            if (command != null && command.equals(INTENT_COMMAND_START)) {
                startFetcging();
            }
        }
        return 1;
    }




    public void start(){
        getLocation();
    }

    public void stop(){

    }







    @Override
    public void onLocationChanged(Location location) {
        /*Intent setConfigIntent = new Intent(MapActivity.ACTION_LOCATIONCOORDINATES);
        Bundle bundle = new Bundle();
        bundle.putDouble("locationLat", location.getLatitude());
        bundle.putDouble("locationLng", location.getLongitude());
        setConfigIntent.putExtras(bundle);
        LocalBroadcastManager.getInstance(CurierApp.getInstanse().getApplicationContext()).sendBroadcast(setConfigIntent);*/
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {
        startFetcging();
    }

    @Override
    public void onProviderDisabled(String provider) {
        int u=1;
    }


    public Location getLocation() {
        try {
            locationManager = (LocationManager) getSystemService(Activity.LOCATION_SERVICE);
            // getting GPS status
            isGPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
            // getting network status
            isNetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
            if ( Build.VERSION.SDK_INT >= 23 &&
                    ContextCompat.checkSelfPermission(getBaseContext(), android.Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED &&
                    ContextCompat.checkSelfPermission( getBaseContext(), android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                return  null;
            }
            locationManager.requestLocationUpdates(
                    LocationManager.NETWORK_PROVIDER,
                    MIN_TIME_BW_UPDATES,
                    minDistance, this);
            locationManager.requestLocationUpdates(
                    LocationManager.GPS_PROVIDER,
                    MIN_TIME_BW_UPDATES,
                    minDistance, this);
            if (!isGPSEnabled && !isNetworkEnabled) {

            } else {
                this.canGetLocation = true;
                // First get location from Network Provider
                if (isNetworkEnabled) {
                    locationManager.requestLocationUpdates(
                            LocationManager.NETWORK_PROVIDER,
                            MIN_TIME_BW_UPDATES,
                            minDistance, this);
                    Log.d("Network", "Network");
                    if (locationManager != null) {
                        location = locationManager
                                .getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
                        if (location != null) {
                            latitude = location.getLatitude();
                            longitude = location.getLongitude();
                        }
                    }
                }
                // if GPS Enabled get lat/long using GPS Services
                if (isGPSEnabled) {
                    if (location == null) {
                        locationManager.requestLocationUpdates(
                                LocationManager.GPS_PROVIDER,
                                MIN_TIME_BW_UPDATES,
                                minDistance, this);
                        Log.d("GPS Enabled", "GPS Enabled");
                        if (locationManager != null) {
                            location = locationManager
                                    .getLastKnownLocation(LocationManager.GPS_PROVIDER);
                            if (location != null) {
                                latitude = location.getLatitude();
                                longitude = location.getLongitude();
                            }
                        }
                    }
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return location;
    }



    public double getLatitude(){
        if(location != null){
            latitude = location.getLatitude();
        }
        return latitude;
    }

    public double getLongitude(){
        if(location != null){
            longitude = location.getLongitude();
        }
        return longitude;
    }


    @Override
    public boolean onUnbind(Intent intent) {
        if ( Build.VERSION.SDK_INT >= 23 &&
                ContextCompat.checkSelfPermission(getBaseContext(), android.Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED &&
                ContextCompat.checkSelfPermission( getBaseContext(), android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return super.onUnbind(intent);
        }
        locationManager.removeUpdates(this);
        return super.onUnbind(intent);
    }

    @Override
    public void onDestroy() {
        if (timer!=null){
            timer.cancel();
        }
        if ( Build.VERSION.SDK_INT >= 23 &&
                ContextCompat.checkSelfPermission(getBaseContext(), android.Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED &&
                ContextCompat.checkSelfPermission( getBaseContext(), android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            super.onDestroy();
        }
        locationManager.removeUpdates(this);
        super.onDestroy();
    }


    public void startFetcging(){
        try {
            locationManager = (LocationManager) getSystemService(Activity.LOCATION_SERVICE);
            // getting GPS status
            isGPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
            // getting network status
            isNetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
            if ( Build.VERSION.SDK_INT >= 23 &&
                    ContextCompat.checkSelfPermission(getBaseContext(), android.Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED &&
                    ContextCompat.checkSelfPermission( getBaseContext(), android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                return;
            }
            locationManager.requestLocationUpdates(
                    LocationManager.GPS_PROVIDER,
                    MIN_TIME_BW_UPDATES,
                    minDistance, this);
            /*locationManager.requestLocationUpdates(
                    LocationManager.NETWORK_PROVIDER,
                    MIN_TIME_BW_UPDATES,
                    minDistance, this);*/
            if (!isGPSEnabled && !isNetworkEnabled) {
                /*Intent setConfigIntent = new Intent(MapActivity.ACTION_LOCATIONCOORDINATES);
                Bundle bundle = new Bundle();
                bundle.putDouble("locationLat", 0);
                bundle.putDouble("locationLng", 0);
                setConfigIntent.putExtras(bundle);
                LocalBroadcastManager.getInstance(ZkhApp.getInstanse().getApplicationContext()).sendBroadcast(setConfigIntent);*/
            } else {
                this.canGetLocation = true;
                // First get location from Network Provider
                if (isNetworkEnabled) {
                    locationManager.requestLocationUpdates(
                            LocationManager.NETWORK_PROVIDER,
                            MIN_TIME_BW_UPDATES,
                            minDistance, this);
                    Log.d("Network", "Network");
                    if (locationManager != null) {
                        location = locationManager
                                .getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
                        if (location != null) {
                            latitude = location.getLatitude();
                            longitude = location.getLongitude();
                            /*Intent setConfigIntent = new Intent(MapActivity.ACTION_LOCATIONCOORDINATES);
                            Bundle bundle = new Bundle();
                            bundle.putDouble("locationLat", latitude);
                            bundle.putDouble("locationLng", longitude);
                            setConfigIntent.putExtras(bundle);
                            LocalBroadcastManager.getInstance(CurierApp.getInstanse().getApplicationContext()).sendBroadcast(setConfigIntent);*/
                        }
                    }
                }
                // if GPS Enabled get lat/long using GPS Services
                if (isGPSEnabled) {
                    if (location == null) {
                        locationManager.requestLocationUpdates(
                                LocationManager.GPS_PROVIDER,
                                MIN_TIME_BW_UPDATES,
                                minDistance, this);
                        Log.d("GPS Enabled", "GPS Enabled");
                        if (locationManager != null) {
                            location = locationManager
                                    .getLastKnownLocation(LocationManager.GPS_PROVIDER);
                            if (location != null) {
                                /*latitude = location.getLatitude();
                                longitude = location.getLongitude();
                                Intent setConfigIntent = new Intent(MapActivity.ACTION_LOCATIONCOORDINATES);
                                Bundle bundle = new Bundle();
                                bundle.putDouble("locationLat", latitude);
                                bundle.putDouble("locationLng", longitude);
                                setConfigIntent.putExtras(bundle);
                                LocalBroadcastManager.getInstance(CurierApp.getInstanse().getApplicationContext()).sendBroadcast(setConfigIntent);*/
                            }
                        }
                    }
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }








}
