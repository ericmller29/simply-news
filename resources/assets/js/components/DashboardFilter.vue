<script>
    export default {
        props: ['filter'],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            filterNews(){
                window.location = '/' + this.filter;
            }
        }
    }
</script>
