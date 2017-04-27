<template>
    <section class="feed">
		<article class="article panel" v-for="article in parsedArticles">
			<a v-bind:href="article.url" v-bind:title="article.title" target="_blank">
                <div class="article-image with-margin-bottom" v-if="article.image">
                    <img v-bind:src="updateImage(article.image, 'w', 1000)" v-bind:alt="article.title">
                </div>
				<h2>{{ article.title }}</h2>
				<span class="date with-margin-bottom">{{ parseDate(article.published_date) }}</span>
                <div class="article-content">
                    <p>{{ article.summary }}</p>
                </div>
                <span class="source"><em>Source: {{ article.source.name }}</em></span>
			</a>
		</article>
		<div class="loader text-center with-margin-bottom" v-if="displayLoader"><img src="http://newsapp.dev/img/loader.gif"></div>
		<div class="done-msg with-margin-bottom text-center" v-if="done">No more articles to display!</div>
	</section>
</template>

<script>
	import moment from 'moment';
	import tz from 'moment-timezone';
	import axios from 'axios';

	export default{
		props: ['articles', 'filter'],
		data: function(){
			return {
				parsedArticles: [],
				currentArticleNum: 10,
				articlesToDisplay: 10,
				displayLoader: false,
				done: false
			}
		},
		mounted(){
			var _this = this;

			this.parsedArticles = JSON.parse(this.articles);

			window.onscroll = function(){
			    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
			        _this.loadMoreArticles();
			    }
			}
		},
		methods: {
			parseDate(date){
				var timezone = moment.tz.guess();

				return moment.utc(date).tz(timezone).format('MMMM Do, Y h:mm a');
			},
			loadMoreArticles(){
				var _this = this;
				var nextSet = this.currentArticleNum + this.articlesToDisplay;
				
				axios.get('/articles/' + this.filter, { params: { offset: nextSet } })
					.then(function(payload){
						_this.displayLoader = true;
						
						if(payload.data.length < 10){
							_this.done = true;
						}

						if(_this.done){
							_this.displayLoader = false;
							return false;
						}

						setTimeout(() => {
							_this.parsedArticles = _this.parsedArticles.concat(payload.data);
							_this.currentArticleNum = nextSet;
							_this.displayLoader = false;
						}, 1000);
					});
			},
			updateImage(uri, key, value) {
				var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
				var separator = uri.indexOf('?') !== -1 ? "&" : "?";

				if (uri.match(re)) {
					return uri.replace(re, '$1' + key + "=" + value + '$2');
				}
				else {
					return uri + separator + key + "=" + value;
				}
			}
		}
	}
</script>