<template>
    <ul class="pagination">
        <li class="page-item cursor-pagination" :class="currentPage == 1 ? 'disabled' : ''">
            <span  class="page-link" @click="getData(1)">First</span>
        </li>
        <li class="page-item cursor-pagination" :class="currentPage == 1 ? 'disabled' : ''">
            <span class="page-link" @click="getData(currentPage, 'prev')">Previous</span>
        </li>

        <li class="page-item" v-if="currentPage > 4 && pagination.total_page > 7">
            <a class="page-link">...</a>
        </li>

        <li class="page-item cursor-pagination" v-for="page in pages" :class="currentPage == page ? 'active' : ''">
            <a style="cursor: pointer" class="page-link" @click="getData(page)">{{page}}</a>
        </li>

        <li class="page-item" v-if="pagination.total_page > 7 && (currentPage + 3 < pagination.total_page)">
            <a class="page-link">...</a>
        </li>

        <li class="page-item cursor-pagination" :class="currentPage == pagination.total_page ? 'disabled' : ''">
            <span class="page-link" @click="getData(currentPage, 'next')">Next</span>
        </li>
        <li class="page-item cursor-pagination" :class="currentPage == pagination.total_page ? 'disabled' : ''">
            <span class="page-link" @click="getData(pagination.total_page)">Last</span>
        </li>
    </ul>
</template>

<script>
    import Request from '../../Request/Request';

    export default {
        name: "Pagination",
        props: {
            pagination: {type: Object, default: {}},
            searchData: {type: Object, default: {}},
        },
        data() {
            return {
                currentPage: 1,
                pages: []
            }
        },
        watch: {
            pagination (data) {
                this.currentPage = data.current_page;
                this.createPageNumber(this.currentPage);
            }
        },
        methods: {
            getData (page, action) {
                if (action == 'prev' && this.currentPage > 1) {
                    page = this.currentPage - 1;
                } else if (action == 'next' && this.currentPage < this.pagination.total_page) {
                    page = this.currentPage + 1;
                } else if (this.currentPage == page) {
                    return;
                }
                this.createPageNumber(page);
                this.currentPage = page;

                let searchData = {
                    name: this.searchData.name,
                    cat_id: this.searchData.cat_id,
                    page: page,
                };

                Request.get(this.pagination.path, searchData)
                    .then(response => {
                        this.$emit('changePaginationData', response.data);
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            createPageNumber (currentPage) {
                let pages = [];
                let start;
                let end;
                let i;
                let totalPage = this.pagination.total_page;

                if (totalPage <= 7) {
                    start = 1;
                    end = totalPage;
                } else {
                    if (currentPage > 4 && (currentPage + 3 > totalPage)) {
                        start = totalPage - 6;
                        end = totalPage
                    } else if (currentPage > 4 && (currentPage + 3 <= totalPage)) {
                        start = currentPage - 3;
                        end = currentPage + 3;
                    } else {
                        start = 1;
                        end = 7;
                    }
                }

                for (i = start; i <= end; i++) {
                    pages.push(i);
                }
                this.pages = pages;
            }
        },
    }
</script>

<style scoped>

</style>