package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.natateam.myzkh.ApiFacade;
import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.NetworkUtils;
import com.natateam.myzkh.R;
import com.natateam.myzkh.adapters.BillServiceAdapter;
import com.natateam.myzkh.managers.SharedManager;
import com.natateam.myzkh.net.*;

import org.w3c.dom.Text;

/**
 * Created by macbook on 30/01/ 15.
 */
public class MainFragment extends BaseFragment implements View.OnClickListener {
    private RecyclerView serviceList;
    private BillServiceAdapter adapter;
    public static final String TAG="com.natateam.myzkh.fragments.MainFragment";
    BaseActivity activity;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_main,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(BaseActivity)getActivity();
        serviceList=(RecyclerView)getView().findViewById(R.id.billlist);
        serviceList.setLayoutManager(new LinearLayoutManager(getActivity()));
        adapter=new BillServiceAdapter(dbManager.getAllServices(),this,false);
        serviceList.setAdapter(adapter);
        if (NetworkUtils.isNetworkAvailable(activity)){
            ApiFacade.getInstance().getProfile(new Listener() {
                @Override
                public void onResponse(BaseRequest request) {
                    adapter.notifyDataSetChanged();
                }

                @Override
                public void onError(com.natateam.myzkh.net.Error error, BaseRequest request) {
                    int u=1;
                }
            });
        }
    }

    @Override
    public void onHiddenChanged(boolean hidden) {
        super.onHiddenChanged(hidden);
        if (!hidden){
            adapter.notifyDataSetChanged();
        }
    }

    @Override
    public void onClick(View v) {
        boolean isFull= SharedManager.getInstase().isProfileFull();
        if (isFull){
           TextView txtServiceId=(TextView)v.findViewById(R.id.serviceIdtext);
           SharedManager.getInstase().setCurrentServiceId(Integer.parseInt(txtServiceId.getText().toString()));
           if (dbManager.getBillByBillService(Integer.parseInt(txtServiceId.getText().toString()))==null) {
               activity.setFragmentByTag(BillFragment.TAG, R.id.frag_content, false);
           }else {
               activity.setFragmentByTag(HistoryFragment.TAG,R.id.frag_content,false);
           }
        }else {
            SharedManager.getInstase().setIsNeedAddBill(true);
            activity.setFragmentByTag(ProfileFragment.TAG, R.id.frag_content, false);
        }
    }
}
