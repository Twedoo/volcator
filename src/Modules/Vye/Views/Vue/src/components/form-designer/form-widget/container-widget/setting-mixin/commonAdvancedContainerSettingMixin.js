export default {
    computed: {
        overflow() {
            return this.widget.options.overflow;
        },
        border() {
            return this.widget.options.border;
        },
        boxShadow() {
            if (this.widget.options.boxShadow) {
                return this.widget.options.boxShadow;
            }
            return "tsz-shadow-none";
        },
        minWidth() {
            return this.widget.options.minWidth;
        },
        maxWidth() {
            return this.widget.options.maxWidth;
        },
        minHeight() {
            return this.widget.options.minHeight;
        },
        maxHeight() {
            return this.widget.options.maxHeight;
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
    }
};
