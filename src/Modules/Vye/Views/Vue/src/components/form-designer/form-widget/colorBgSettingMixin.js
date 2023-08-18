export default {
    computed: {
        colorBgOrGradient() {
            let result;
            if (this.field.options.activeGradientBg) {
                result =
                    this.field.options.directionGradientBg + " " +
                    this.field.options.fromColorBg + " " +
                    this.field.options.viaColorBg + " " +
                    this.field.options.toColorBg;
            } else {
                result = this.onlyColorBg;
            }
            return result;
        },
        onlyColorBg() {
            return this.field.options.bgColor;
        },
        customBackgroundColor() {
            if (this.field.options.activeCustomBackgroundColor) {
                return this.field.options.backgroundColor;
            } else {
                return '';
            }
        },
    }
};
