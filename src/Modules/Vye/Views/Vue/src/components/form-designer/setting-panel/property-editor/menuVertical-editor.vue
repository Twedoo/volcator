<template>
	<el-form-item :label="i18nt('designer.setting.labelIconPosition')">
		<el-select v-model="optionModel.menuVertical">
			<el-option
				v-for="item in labelIconPosition"
				:key="item.value"
				:label="item.label"
				:value="item.value"></el-option>
		</el-select>
	</el-form-item>
</template>

<script>
import i18n from '@/utils/i18n';

export default {
	name: 'MenuVerticalEditor',
	mixins: [i18n],
	props: {
		designer: Object,
		selectedWidget: Object,
		optionModel: Object,
	},
	data() {
		return {
			labelIconPosition: [
				{ label: 'front', value: 'front' },
				{ label: 'rear', value: 'rear' },
			],
		};
	},
};
</script>

<!--<script>-->
<!--    // import {-->
<!--    //     Document,-->
<!--    //     Menu as IconMenu,-->
<!--    //     Location,-->
<!--    //     Setting,-->
<!--    // } from '@element-plus/icons-vue'-->
<!--    // const handleOpen = (key: string, keyPath: string[]) => {-->
<!--    //     console.log(key, keyPath)-->
<!--    // }-->
<!--    // const handleClose = (key: string, keyPath: string[]) => {-->
<!--    //     console.log(key, keyPath)-->
<!--    // }-->
<!--    import i18n from "@/utils/i18n"-->

<!--    export default {-->
<!--        name: "menu-vertical-editor",-->
<!--        mixins: [i18n],-->
<!--        props: {-->
<!--            designer: Object,-->
<!--            selectedWidget: Object,-->
<!--            optionModel: Object,-->
<!--        },-->
<!--    }-->
<!--</script>-->
