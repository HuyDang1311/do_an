<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'customer.create'}" class="btn btn-success">Create customer</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Customer list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Website</th>
                        <th>Email</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer, index in customers">
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.address }}</td>
                        <td>{{ customer.website }}</td>
                        <td>{{ customer.email }}</td>
                        <td>
                            <router-link :to="{name: 'customer.edit', params: {id: customer.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(customer.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                customers: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/customers')
                .then(function (resp) {
                    app.customers = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load customers");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/customers/' + id)
                        .then(function (resp) {
                            app.customers.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete customer");
                        });
                }
            }
        }
    }
</script>