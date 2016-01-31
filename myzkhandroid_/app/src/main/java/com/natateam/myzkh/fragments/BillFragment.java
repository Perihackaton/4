package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.LinearLayout;

import com.natateam.myzkh.ApiFacade;
import com.natateam.myzkh.AppUtils;
import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.NetworkUtils;
import com.natateam.myzkh.R;
import com.natateam.myzkh.ZkhApp;
import com.natateam.myzkh.adapters.HistoryItemAdapter;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillService;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.net.*;
import com.natateam.myzkh.screens.MainActivity;

/**
 * Created by macbook on 30/01/ 15.
 */
public class BillFragment extends BaseFragment {
    public static final String TAG="com.natateam.myzkh.fragments.BillFragment";
    private LinearLayout layoutQr;
    private EditText editBill;
    private MainActivity activity;
    private Button btnSave;
    private CheckBox checkboxscore;
    private int service_id;
    Bill currentBill;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_bill,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(MainActivity)getActivity();
        layoutQr=(LinearLayout)getView().findViewById(R.id.layoutQr);
        layoutQr.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ((MainActivity)getActivity()).showScan();
            }
        });
        editBill=(EditText)getView().findViewById(R.id.editBill);
        checkboxscore=(CheckBox)getView().findViewById(R.id.switchScore);
        btnSave=(Button)getView().findViewById(R.id.btnSave);
        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String bill=editBill.getText().toString();
                if (bill.length()<10){
                    ZkhApp.getInstanse().showToast(getString(R.string.enter_bill));
                    return;
                }
                if (NetworkUtils.isNetworkAvailable(activity)){
                    activity.showProgress();
                    ApiFacade.getInstance().addBill(bill, service_id, new Listener() {
                        @Override
                        public void onResponse(BaseRequest request) {
                            activity.hideProgress();
                            dbManager.addBill(bill,service_id);
                            ZkhApp.getInstanse().showToast(getString(R.string.bill_add));
                            activity.setFragmentByTag(HistoryFragment.TAG,R.id.frag_content,false);
                        }

                        @Override
                        public void onError(com.natateam.myzkh.net.Error error, BaseRequest request) {
                            activity.hideProgress();
                        }
                    });
                }else {
                    ZkhApp.getInstanse().showToast(getString(R.string.check_internet_toast));
                }

            }
        });
        setBillInfo();

    }

    public void setBill(String text){
        if (editBill!=null){
            editBill.setText(text);
        }
    }

    public void setBillInfo(){
        editBill.setText("");
        service_id=SharedManager.getInstase().getCurrentServiceId();
        BillService billService=dbManager.getBillServiceById(service_id);
        activity.setTitle(billService.getName());
        activity.setTopImage(AppUtils.getServiceDrawable(service_id));
        currentBill=dbManager.getBillByBillService(service_id);
        if (currentBill!=null){
            editBill.setText(currentBill.getBill());
        }
    }

    @Override
    public void onHiddenChanged(boolean hidden) {
        super.onHiddenChanged(hidden);
        if (!hidden){
            setBillInfo();
        }
    }
}
