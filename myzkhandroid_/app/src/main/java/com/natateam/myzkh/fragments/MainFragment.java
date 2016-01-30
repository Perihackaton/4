package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.natateam.myzkh.R;
import com.natateam.myzkh.adapters.BillServiceAdapter;

/**
 * Created by macbook on 30/01/ 15.
 */
public class MainFragment extends BaseFragment implements View.OnClickListener {
    private RecyclerView serviceList;
    private BillServiceAdapter adapter;
    public static final String TAG="com.natateam.myzkh.fragments.MainFragment";
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_main,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        serviceList=(RecyclerView)getView().findViewById(R.id.billlist);
        serviceList.setLayoutManager(new LinearLayoutManager(getActivity()));
        adapter=new BillServiceAdapter(dbManager.getAllServices(),this);
        serviceList.setAdapter(adapter);

    }

    @Override
    public void onClick(View v) {

    }
}
