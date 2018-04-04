package com.group4.rottenpotatoes;

public class Song {
    private String artist;
    private String title;
    private String link;
    private String review;
    private String genre;

    public Song(String artist, String title, String link, String review, String genre)
    {
        this.artist = artist;
        this.title = title;
        this.link = link;
        this.review = review;
        this.genre = genre;
    }

    public String getArtist() {
        return artist;
    }

    public void setArtist(String artist) {
        this.artist = artist;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getLink() {
        return link;
    }

    public void setLink(String link) {
        this.link = link;
    }

    public String getReview() {
        return review;
    }

    public void setReview(String review) {
        this.review = review;
    }

    public String getGenre() {
        return genre;
    }

    public void setGenre(String genre) {
        this.genre = genre;
    }
}
