<template>

    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">
                                <datepicker v-model="dateSearch"></datepicker>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Group Name</th>
                                    <th>Group Type</th>
                                    <th>Account Name</th>
                                    <th>Post Text</th>
                                    <th>Time</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-show="bufferPostings.length" v-for="(bufferPosting, index) in bufferPostings" :key="bufferPosting.id">
                                    <td>{{ bufferPosting.group_info.name }}</td>
                                    <td>{{bufferPosting.group_info.type.replace('-', " ") | upText  }}</td>

                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="">
                                                    <img width="50" class="media-object img-circle"
                                                         v-bind:src="bufferPosting.account_info.avatar"/>
                                                </a>
                                            </div>
                                            <div class="media-body media-middle" style="width: 180px;">
                                                <h4 class="media-heading">{{ bufferPosting.account_info.name }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ bufferPosting.post_text }}</td>
                                    <td>{{ bufferPosting.created_at | formatDate  }}</td>

                                </tr>

                                <tr v-show="!bufferPostings.length">
                                    <td colspan="6">
                                        <p class="text-danger" >No Bufferpost Found.</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <pagination v-if="pagination.last_page > 1"
                                        :pagination="pagination"
                                        :offset="5"
                                        @paginate="loadBufferPostings()">
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            Datepicker
        },
        data(){
            return{
                bufferPostings: {},
                dateSearch: '',
                pagination:{current_page:1}
            }
        },
        mounted(){
            this.loadBufferPostings();
        },
        methods:{
            loadBufferPostings(){
                axios.get("/buffer-result?page="+this.pagination.current_page)
                    .then(({data})  => (
                        this.bufferPostings = data.data,
                        this.pagination = data
                    ))
                    .catch(e => console.log(e));
            },
            getResults(page = 1){
                axios.get("/buffer-result?page="+page)
                    .then(response => {
                        this.bufferPostings = response.data
                    })
            }
        }
    }
</script>
