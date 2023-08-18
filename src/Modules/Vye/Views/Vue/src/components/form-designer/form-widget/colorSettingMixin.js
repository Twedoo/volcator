export default {
    computed: {
        colorOrGradient() {
            let result;
            if (this.field.options.activeGradient) {
                result =
                    "tsz-bg-clip-text tsz-text-transparent " +
                    this.field.options.directionGradient + " " +
                    this.field.options.fromColor + " " +
                    this.field.options.viaColor + " " +
                    this.field.options.toColor;
            } else {
                result = this.onlyColor;
            }
            return result;
        },
        onlyColor() {
            return this.field.options.color;
        },
    }
};
