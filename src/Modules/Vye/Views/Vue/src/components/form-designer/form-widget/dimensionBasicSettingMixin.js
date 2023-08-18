export default {
    computed: {
        width() {
            return this.field.options.width;
        },
        height() {
            return this.field.options.height;
        },
        margin() {
            return this.field.options.margin;
        },
        padding() {
            return this.field.options.padding;
        }
    }
};
