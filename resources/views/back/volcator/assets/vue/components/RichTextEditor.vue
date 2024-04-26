

<template>
    <div>
        <div ref="editor" />
    </div>
</template>

<script>
    import { Editor } from '@tiptap/core'
    import StarterKit from '@tiptap/starter-kit'

    export default {
        mounted() {
            const editor = new Editor({
                content: '<p>Hello, TipTap!</p>',
                extensions: [
                    StarterKit
                ]
            })

            editor.mount(this.$refs.editor)
        }
    }
</script>
