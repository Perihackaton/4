package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.natateam.myzkh.AppUtils;
import com.natateam.myzkh.R;
import com.natateam.myzkh.adapters.HistoryItemAdapter;
import com.natateam.myzkh.dbmodel.Bill;
import com.natateam.myzkh.dbmodel.BillService;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.screens.MainActivity;

/**
 * Created by macbook on 30/01/ 15.
 */
public class HistoryFragment extends BaseFragment implements View.OnClickListener {
    public static final String TAG="com.natateam.myzkh.fragments.HistoryFragment";
    RecyclerView historyList;
    HistoryItemAdapter historyItemAdapter;
    private Bill bill;
    private BillService billService;
    private MainActivity activity;
    private TextView txtTariff;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_history,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(MainActivity)getActivity();
        historyList=(RecyclerView)getView().findViewById(R.id.historylist);
        historyList.setLayoutManager(new LinearLayoutManager(getActivity()));
        bill=dbManager.getBillByBillService(SharedManager.getInstase().getCurrentServiceId());
        billService=dbManager.getBillServiceById(bill.getService_id());
        activity.setTitle(billService.getName());
        historyItemAdapter=new HistoryItemAdapter(dbManager.getHistoryItemsForBill(bill.getBill()),this);
        historyList.setAdapter(historyItemAdapter);
        activity.setTopImage(AppUtils.getServiceDrawable(billService.getService_id()));
        txtTariff=(TextView)getView().findViewById(R.id.txtTariff);
        txtTariff.setText(getString(R.string.current_tariff)+" 50.01 р/кв.м ");

    }

    public void updateHistory(){
        bill=dbManager.getBillByBillService(SharedManager.getInstase().getCurrentServiceId());
        billService=dbManager.getBillServiceById(bill.getService_id());
        historyItemAdapter.setmDataset(dbManager.getHistoryItemsForBill(bill.getBill()));
        activity.setTitle(billService.getName());
        activity.setTopImage(AppUtils.getServiceDrawable(billService.getService_id()));
    }

    @Override
    public void onHiddenChanged(boolean hidden) {
        super.onHiddenChanged(hidden);
        if (!hidden){
            updateHistory();
        }
    }

    @Override
    public void onClick(View v) {

    }
}
