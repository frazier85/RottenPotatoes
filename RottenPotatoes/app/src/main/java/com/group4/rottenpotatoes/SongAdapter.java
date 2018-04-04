package com.group4.rottenpotatoes;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

public class SongAdapter extends RecyclerView.Adapter<SongAdapter.SongViewHolder> {

    private Context mCtx;
    private List<Song> songList;

    public SongAdapter(Context mCtx, List<Song> productList) {
        this.mCtx = mCtx;
        this.songList = productList;
    }

    @Override
    public SongViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(mCtx);
        View view = inflater.inflate(R.layout.search_activity, null);
        return new SongViewHolder(view);
    }

    @Override
    public int getItemCount() {
        return songList.size();
    }

    @Override
    public void onBindViewHolder(SongViewHolder holder, int position) {
        Song song = songList.get(position);

        holder.textViewTitle.setText(song.getTitle());
        holder.textViewArtist.setText(song.getArtist());
        holder.textViewLink.setText(String.valueOf(song.getLink()));
        holder.textViewGenre.setText(String.valueOf(song.getGenre()));
        holder.textViewReview.setText(String.valueOf(song.getReview()));
    }

        class SongViewHolder extends RecyclerView.ViewHolder {

        TextView textViewTitle, textViewArtist, textViewLink, textViewGenre, textViewReview;
        ImageView imageView;

        public SongViewHolder(View itemView) {
            super(itemView);

            // TODO: Fix this. Needs to be modified to handle our songs
            // textViewTitle = itemView.findViewById(R.id.textViewTitle);
            // textViewShortDesc = itemView.findViewById(R.id.textViewShortDesc);
            // textViewRating = itemView.findViewById(R.id.textViewRating);
            // textViewPrice = itemView.findViewById(R.id.textViewPrice);
            // imageView = itemView.findViewById(R.id.imageView);


        }
    }

}
