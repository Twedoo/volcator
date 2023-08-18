export default {
    computed: {
        flex() {
            if (this.widget.options.flex) {
                return this.widget.options.flex;
            }
            return "tsz-flex";
        },
        alignItem() {
            if (this.widget.options.alignItem) {
                return this.widget.options.alignItem;
            }
            return "tsz-items-center";
        },
        justify() {
            if (this.widget.options.justify) {
                return this.widget.options.justify;
            }
            return "tsz-justify-start";
        },
        overflow() {
            return this.widget.options.overflow;
        },
        boxShadow() {
            if (this.widget.options.boxShadow) {
                return this.widget.options.boxShadow;
            }
            return "tsz-shadow-none";
        },
        flexWrap() {
            if (this.widget.options.flexWrap) {
                return this.widget.options.flexWrap;
            }
            return "tsz-flex-nowrap";
        },
        margin() {
            return this.widget.options.margin;
        },
        padding() {
            return this.widget.options.padding;
        },
        width() {
            return this.widget.options.width;
        },
        minWidth() {
            return this.widget.options.minWidth;
        },
        maxWidth() {
            return this.widget.options.maxWidth;
        },
        height() {
            return this.widget.options.height;
        },
        minHeight() {
            return this.widget.options.minHeight;
        },
        maxHeight() {
            return this.widget.options.maxHeight;
        },
        border() {
            return this.widget.options.border;
        },
        position() {
            return this.widget.options.position;
        },
        placementTrbl() {
            return this.widget.options.placementTrbl;
        },
        float() {
            return this.widget.options.float;
        },
        objectPosition() {
            return this.widget.options.objectPosition;
        }
        /**
         * settings text
         */
    }
};
