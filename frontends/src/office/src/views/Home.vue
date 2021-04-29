<template>
  <div>
    <ThailandAutoComplete
      v-model="district"
      type="district"
      label="ตำบล"
      color="#42b883"
      size="default"
      placeholder="ตำบล..."
      @select="select"
    />

    <ThailandAutoComplete
      v-model="amphoe"
      type="amphoe"
      label="อำเภอ"
      placeholder="อำเภอ..."
      @select="select"
    />

    <ThailandAutoComplete
      v-model="province"
      type="province"
      label="จังหวัด"
      size="medium"
      color="#35495e"
      placeholder="จังหวัด..."
      @select="select"
    />

    <ThailandAutoComplete
      v-model="zipcode"
      type="zipcode"
      size="large"
      color="#00a4e4"
      placeholder="รหัสไปรษณีย์..."
      @select="select"
    />

  </div>
</template>

<script>
import ThailandAutoComplete from 'vue-thailand-address-autocomplete'

export default {
  components: {
    ThailandAutoComplete,
  },
  data() {
    return {
      district: '',
      amphoe: '',
      province: '',
      zipcode: '',
    }
  },
  methods: {
    select(address) {
      this.district = address.district
      this.amphoe = address.amphoe
      this.province = address.province
      this.zipcode = address.zipcode
      console.log(address)
    },
  },
}
</script>
