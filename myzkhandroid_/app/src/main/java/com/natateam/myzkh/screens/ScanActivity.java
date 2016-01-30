package com.natateam.myzkh.screens;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;

import com.natateam.myzkh.ZkhApp;

import java.util.ArrayList;
import java.util.List;

import me.dm7.barcodescanner.zbar.BarcodeFormat;
import me.dm7.barcodescanner.zbar.Result;
import me.dm7.barcodescanner.zbar.ZBarScannerView;

/**
 * Created by macbook on 30/01/ 15.
 */
public class ScanActivity extends Activity implements ZBarScannerView.ResultHandler {
    private ZBarScannerView mScannerView;

    @Override
    public void onCreate(Bundle state) {
        super.onCreate(state);
        mScannerView = new ZBarScannerView(this);
        List<BarcodeFormat> formats= new ArrayList();
        formats.add(BarcodeFormat.QRCODE);
        mScannerView.setFormats(formats);
        // Programmatically initialize the scanner view
        setContentView(mScannerView);                // Set the scanner view as the content view
    }

    @Override
    public void onResume() {
        super.onResume();
        mScannerView.setResultHandler(this); // Register ourselves as a handler for scan results.
        mScannerView.startCamera();          // Start camera on resume
    }

    @Override
    public void onPause() {
        super.onPause();
        mScannerView.stopCamera();           // Stop camera on pause
    }

    @Override
    public void handleResult(Result rawResult) {
        // Do something with the result here
        ZkhApp.getInstanse().showToast(rawResult.getContents());
        Log.v("qrcode", rawResult.getContents()); // Prints scan results
        Log.v("qrcode", rawResult.getBarcodeFormat().getName());
        // Prints the scan format (qrcode, pdf417 etc.)
        // If you would like to resume scanning, call this method below:
        mScannerView.resumeCameraPreview(this);
        Intent intent= new Intent();
        intent.putExtra("code",rawResult.getContents());
        setResult(RESULT_OK,intent);
        finish();

    }
}
