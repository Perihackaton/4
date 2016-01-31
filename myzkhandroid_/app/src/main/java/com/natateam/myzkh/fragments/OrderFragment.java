package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.natateam.myzkh.R;
import com.natateam.myzkh.adapters.OrderAdapter;

/**
 * Created by macbook on 31/01/ 15.
 */
public class OrderFragment extends BaseFragment implements View.OnClickListener {
    public static final String TAG="com.natateam.myzkh.fragments.OrderFragment";
    RecyclerView orderList;
    OrderAdapter orderAdapter;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_news,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        orderList=(RecyclerView)getView().findViewById(R.id.newslist);
        orderList.setLayoutManager(new LinearLayoutManager(getActivity()));
        orderAdapter=new OrderAdapter(dbManager.getAllOrders(),this);
        orderList.setAdapter(orderAdapter);
    }

    @Override
    public void onClick(View v) {

    }
}
