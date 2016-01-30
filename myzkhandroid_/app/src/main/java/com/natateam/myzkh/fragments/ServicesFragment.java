package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.natateam.myzkh.BaseActivity;
import com.natateam.myzkh.R;
import com.natateam.myzkh.adapters.BillServiceAdapter;
import com.natateam.myzkh.managers.SharedManager;

/**
 * Created by macbook on 30/01/ 15.
 */
public class ServicesFragment extends BaseFragment implements View.OnClickListener {
    private RecyclerView serviceList;
    private BillServiceAdapter adapter;
    public static final String TAG = "com.natateam.myzkh.fragments.ServicesFragment";
    private BaseActivity activity;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_main, null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        activity=(BaseActivity)getActivity();
        serviceList = (RecyclerView) getView().findViewById(R.id.billlist);
        serviceList.setLayoutManager(new LinearLayoutManager(getActivity()));
        adapter = new BillServiceAdapter(dbManager.getAllServices(), this,true);
        serviceList.setAdapter(adapter);

    }

    @Override
    public void onClick(View v) {
        TextView txtServiceId=(TextView)v.findViewById(R.id.serviceIdtext);
        SharedManager.getInstase().setCurrentServiceId(Integer.parseInt(txtServiceId.getText().toString()));
        activity.setFragmentByTag(BillFragment.TAG,R.id.frag_content,false);
    }
}

