<template>
    <div>
        <div class="toggle-wrapper mt-5">
            <div class="toggle checkcross">
                <p class="me-3">Pubblico</p>
                <input
                    id="checkcross"
                    type="checkbox"
                    name="visibility"
                    :value="visible"
                    :checked="is_visible ? '' : 'checked'"
                    @change="onChange"
                />
                <label
                    class="toggle-item d-flex align-items-center"
                    for="checkcross"
                >
                    <div class="check"></div>
                </label>
                <p class="ms-3">Privato</p>
            </div>
            <div style="max-width: 70px" class="mx-2 mb-3 d-none">
                <input
                    type="number"
                    class="form-control"
                    name="visibility"
                    id="visibility"
                    :value="visible"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visible: this.is_visible,
        };
    },
    props: ["is_visible"],
    methods: {
        onChange() {
            if (this.visible) {
                this.visible = 0;
            } else {
                this.visible = 1;
            }
        },
    },
    mounted() {},
};
</script>
