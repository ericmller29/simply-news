<script>
    export default {
        props: ['filter'],
        mounted() {
            console.log('Component mounted.')
            console.log(this.filter);
        },
        methods: {
            filterNews(){
                window.location = '/' + this.filter;
            }
        }
    }
</script>
