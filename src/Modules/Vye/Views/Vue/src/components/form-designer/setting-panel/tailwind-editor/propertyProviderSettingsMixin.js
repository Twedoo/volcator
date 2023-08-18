import { ref } from 'vue';
import { getClassesByCommand } from "@/components/service/service-provider-settings.js";

export default {
    computed: {
        collectionName() {
            return ref('');
        },
        dataCollection() {
            return ref([]);
        },
        pageNumber() {
            return ref(1);
        },
        pageSize() {
            return ref(10);
        },
        scrollContainerRef() {
            return ref(null);
        },
        optionItems() {
            if (this.dataCollection.value.length > 0) {
                return this.dataCollection.value;
            } else {
                return [];
            }
        }
    },
	methods: {
        fetchColors(search = null, init = false) {
            const params = {
                collectionName: this.collectionName.value,
                pageNumber: this.pageNumber.value,
                pageSize: this.pageSize.value,
                searchAttribute: 'label',
                sortField: 'label',
                sortOrder: 'desc',
                search: search,
            };
            getClassesByCommand(params).then(response => {
                if (init) {
                    this.dataCollection.value = [];
                }
                this.dataCollection.value = this.dataCollection.value.concat(response.items);
            })
                .catch(error => {
                    console.error('No data.', error);
                });
        },
	    loadRemote() {
            this.pageNumber.value += 1;
            this.fetchColors(null, false);
        },
        filterRemoteMethod(query) {
            if (query.length >= 2) {
                this.pageNumber.value = 1;
                this.fetchColors(query, true);
            }
        },
        setCollectionName(collection) {
            this.collectionName.value = collection;
            this.pageNumber.value = 1;
            this.fetchColors(null, true);
        },
	},
};
