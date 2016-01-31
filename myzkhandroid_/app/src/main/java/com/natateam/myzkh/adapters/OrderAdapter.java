package com.natateam.myzkh.adapters;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.liulishuo.magicprogresswidget.MagicProgressCircle;
import com.natateam.myzkh.R;
import com.natateam.myzkh.dbmodel.NewsItem;
import com.natateam.myzkh.model.OrderItem;

import io.realm.RealmResults;

/**
 * Created by macbook on 31/01/ 15.
 */
public class OrderAdapter extends RecyclerView.Adapter<OrderAdapter.ViewHolder> {
    private RealmResults<OrderItem> mDataset;
    private View.OnClickListener listener;



    // Provide a reference to the views for each data item
// Complex data items may need more than one view per item, and
// you provide access to all the views for a data item in a view holder
    public static class ViewHolder extends RecyclerView.ViewHolder {
        // each data item is just a string in this case
        public View mainView;
        public TextView txtAdress,txtTheme,txtPercent;
        public MagicProgressCircle progressOrder;
        public ImageView img;

        public ViewHolder(View v) {
            super(v);
            mainView = v;
            txtAdress=(TextView)v.findViewById(R.id.txtAdress);
            txtTheme=(TextView)v.findViewById(R.id.txtTheme);
            img=(ImageView)v.findViewById(R.id.imgOrder);
            txtPercent=(TextView)v.findViewById(R.id.txtPercent);
            progressOrder=(MagicProgressCircle)v.findViewById(R.id.orderProgress);
        }
    }

    // Provide a suitable constructor (depends on the kind of dataset)
    public OrderAdapter(RealmResults<OrderItem> items,View.OnClickListener listener) {
        mDataset = items;
        this.listener=listener;
    }

    // Create new views (invoked by the layout manager)
    @Override
    public OrderAdapter.ViewHolder onCreateViewHolder(ViewGroup parent,
                                                     int viewType) {
        // create a new view
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.order_item, parent, false);
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
        final OrderItem item = mDataset.get(position);
        holder.txtTheme.setText(item.getTheme().toUpperCase());
        holder.txtAdress.setText(item.getAdress());
        holder.progressOrder.setPercent(item.getPercent() / 100f);
        holder.txtPercent.setText(Integer.toString(item.getPercent())+"%");

        if (position%2==0){
            holder.img.setImageResource(R.drawable.order_1);
        }else {
            holder.img.setImageResource(R.drawable.order_2);
        }

    }


    // Return the size of your dataset (invoked by the layout manager)
    @Override
    public int getItemCount() {
        return mDataset.size();
    }

    public void setmDataset(RealmResults<OrderItem> mDataset) {
        this.mDataset = mDataset;
        notifyDataSetChanged();
    }
}
