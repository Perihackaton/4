package com.natateam.myzkh.adapters;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.natateam.myzkh.AppUtils;
import com.natateam.myzkh.R;
import com.natateam.myzkh.dbmodel.BillHistoryItem;
import com.natateam.myzkh.dbmodel.NewsItem;

import io.realm.RealmResults;

/**
 * Created by macbook on 30/01/ 15.
 */
public class NewsAdapter extends RecyclerView.Adapter<NewsAdapter.ViewHolder> {
    private RealmResults<NewsItem> mDataset;
    private View.OnClickListener listener;



    // Provide a reference to the views for each data item
// Complex data items may need more than one view per item, and
// you provide access to all the views for a data item in a view holder
    public static class ViewHolder extends RecyclerView.ViewHolder {
        // each data item is just a string in this case
        public View mainView;
        public TextView txtDate,txtTheme,txtText;

        public ViewHolder(View v) {
            super(v);
            mainView = v;
            txtDate=(TextView)v.findViewById(R.id.txtDate);
            txtTheme=(TextView)v.findViewById(R.id.txtTheme);
            txtText=(TextView)v.findViewById(R.id.txtText);
        }
    }

    // Provide a suitable constructor (depends on the kind of dataset)
    public NewsAdapter(RealmResults<NewsItem> items,View.OnClickListener listener) {
        mDataset = items;
        this.listener=listener;
    }

    // Create new views (invoked by the layout manager)
    @Override
    public NewsAdapter.ViewHolder onCreateViewHolder(ViewGroup parent,
                                                            int viewType) {
        // create a new view
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.news_item, parent, false);
        // set the view's size, margins, paddings and layout parameters
        ViewHolder vh = new ViewHolder(v);
        return vh;
    }

    // Replace the contents of a view (invoked by the layout manager)
    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        // - get element from your dataset at this position
        // - replace the contents of the view with that element
        //holder.mTextView.setText(mDataset.get());
        final NewsItem item = mDataset.get(position);
        holder.txtTheme.setText(item.getTheme().toUpperCase());
        holder.txtText.setText(item.getText());
        holder.txtDate.setText(item.getDate());

    }


    // Return the size of your dataset (invoked by the layout manager)
    @Override
    public int getItemCount() {
        return mDataset.size();
    }

    public void setmDataset(RealmResults<NewsItem> mDataset) {
        this.mDataset = mDataset;
        notifyDataSetChanged();
    }
}
