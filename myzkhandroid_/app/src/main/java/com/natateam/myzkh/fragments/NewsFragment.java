package com.natateam.myzkh.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.natateam.myzkh.R;
import com.natateam.myzkh.adapters.NewsAdapter;

/**
 * Created by macbook on 30/01/ 15.
 */
public class NewsFragment extends BaseFragment implements View.OnClickListener{
    public static final String TAG="com.natateam.myzkh.fragments.NewsFragment";
    RecyclerView newsList;
    NewsAdapter newsAdapter;
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_news,null);
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        newsList=(RecyclerView)getView().findViewById(R.id.newslist);
        newsList.setLayoutManager(new LinearLayoutManager(getActivity()));
        newsAdapter=new NewsAdapter(dbManager.getAllNews(),this);
        newsList.setAdapter(newsAdapter);
    }

    @Override
    public void onClick(View v) {

    }
}
