export default {
    computed: {
        width() {
            return this.widget.options.width;
        },
        height() {
            return this.widget.options.height;
        },
        margin() {
            return this.widget.options.margin;
        },
        padding() {
            return this.widget.options.padding;
        }
    }
};
