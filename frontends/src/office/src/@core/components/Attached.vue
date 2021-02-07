<template>
  <section>
    <b-row>
      <b-col>
        <input
          ref="fileAttach"
          type="file"
          accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
          class="d-none"
          @change="handleFile"
        >
      </b-col>
    </b-row>

    <b-row>
      <cool-light-box
        :items="dataInCoolLightBoxFormat"
        :index="index"
        @close="index = null"
      />
    </b-row>

    <b-row>
      <b-col>
        <ul class="attached-document clearfix">
          <li
            v-for="(row, INDEX) in datas"
            :key="INDEX"
            mediaType="video"
            class=""
          >
            <div
              class="document-file"
              @click="openCoolLightBox(index)"
            >
              <a
                v-if="row.file_mime?row.file_mime.startsWith('image'):row.mime_type.startsWith('image')"
                href="javascript:;"
              >
                <img
                  :src="row.link_url?row.link_url:baseurl+row.full_path"
                  class="img-fluid"
                >
              </a>
              <a
                v-else
                href="javascript:;"
              >
                <feather-icon
                  icon="FileIcon"
                  size="50"
                />
              </a>
            </div>
            <div class="document-name">
              <a href="javascript:;">{{ row.file_name }}</a>
              <span class="float-right">
                <feather-icon
                  icon="InfoIcon"
                  size="18"
                  @click="infoFile(index)"
                />
                <feather-icon
                  v-if="readOnly == false"
                  icon="TrashIcon"
                  size="18"
                  @click="deleteFile(index)"
                />
              </span>
            </div>
          </li>

          <li v-if="readOnly == false">
            <div
              class="document-file"
              @click="selectFile"
            >
              <a href="javascript:;">
                <feather-icon
                  icon="PlusIcon"
                  size="50"
                />
              </a>
            </div>
          </li>
        </ul>
      </b-col>
    </b-row>
    <!-- <b-row>
      <b-col>
        <button @click="submit">
          upload
        </button>
      </b-col>
    </b-row> -->
    <!-- <pre>{{ datas }}</pre> -->
  </section>
</template>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  name: 'Attached',
  components: {
    'cool-light-box': CoolLightBox,
  },
  props: {
    modelId: {
      default: '',
      type: String,
    },
    modelName: {
      default: '',
      type: String,
    },
    readOnly: {
      default: false,
      type: Boolean,
    },
  },
  data() {
    return {
      datas: [],
      data: {
        hr_data_id: '',
        hr_attachedfile_id: '',
        file: '',
        hr_attachedfile_item_id: '',
        file_name: '',
        file_path: '',
        file_mime: '',
        link_url: '',
        date: '',
        menu_order: '',
      },
      baseurl: process.env.VUE_APP_API_BASEURL,
      fileAttach: '',
      attachedfile_id: '',
      index: null,
    }
  },
  computed: {
    dataInCoolLightBoxFormat() {
      if (this.datas.length === 0) {
        return []
      }
      return this.datas.map(data => {
        const isPDF = data.file_mime ? this.isPDF(data.file_mime) : this.isPDF(data.mime_type)
        const coolLightBoxFormat = {
          title: data.file_name,
          src: data.link_url ? data.link_url : this.baseurl + data.full_path,
        }
        if (isPDF) {
          coolLightBoxFormat.mediaType = 'iframe'
        }
        return coolLightBoxFormat
      })
    },
  },
  watch: {
    fileAttach: {
      handler(value) {
        if (value) {
          const temp = {
            attachedfile_id: this.attachedfile_id,
            file: value,
            attachedfile_item_id: '',
            file_name: value.name,
            file_path: '',
            file_mime: value.type,
            link_url: URL.createObjectURL(value),
            date: '',
            menu_order: '',
          }
          this.datas.push(temp)
          this.$emit('change', this.datas)
        }
      },
    },
    modelId: {
      handler(value) {
        if (value) {
          this.loadData()
        }
      },
    },
  },
  mounted() {
    this.loadData()
  },
  destroyed() {
    this.datas = []
  },
  methods: {
    isPDF(fileName) {
      return fileName.split('/')[1] === 'pdf'
    },
    async loadData() {
      if (!this.modelId) {
        setTimeout(() => {
          this.loadData()
        }, 500)
        return
      }
      if (this.modelId) {
        const { data } = await this.$http.get(`/api/attached/${this.modelId}`)
        this.datas = data.data
      }
    },
    openCoolLightBox(index) {
      this.index = index
    },
    async submit() {
      return new Promise((resolve, reject) => {
        if (this.datas.length > 0 && this.modelId) {
          const formData = new FormData()
          const files = []

          this.datas.forEach((data, index) => {
            const tempObj = {}
            const keys = Object.keys(data)
            keys.forEach(key => {
              formData.append(`files[${index}][${key}]`, data[key])
              tempObj[key] = data[key]
            })
            files.push(tempObj)
          })
          formData.append('id', this.modelId)
          formData.append('model', this.modelName)

          return resolve(this.$http.post('/api/attached',
            formData, {
              headers: {
                'Content-Type': 'application/json',
              },
            }))
        }
        this.$toast({
          component: ToastificationContent,
          props: {
            title: 'อัพโหลดไฟล์ไม่สำเร็จ',
            icon: 'XCircleIcon',
            variant: 'danger',
          },
        })
        return reject(new Error('Not set ID or Model'))
      })
    },
    handleFile(e) {
      this.fileAttach = ''
      // eslint-disable-next-line prefer-destructuring
      this.fileAttach = e.target.files[0]
    },
    selectFile() {
      this.$refs.fileAttach.click()
    },
    infoFile(id) {
      console.log('infoFile', this.datas[id])
    },
    async deleteFile(id) {
      console.log('deleteFile', this.datas[id])
      if (this.datas[id].id) {
        await this.$http.delete(`/api/attached/${this.datas[id].id}`)
      }
      this.datas.splice(id, 1)
    },
    clearData() {
      this.datas = []
      this.fileAttach = ''
      this.$refs.fileAttach.value = ''
    },
  },
}
</script>

<style>
/* Pages - Email Detail */
.attached-document {
  list-style-type: none;
  margin: 15px 0 0;
  padding: 0;
}
.attached-document > li {
  width: 180px;
  float: left;
  background: #fff;
  color: #2e353c;
  font-weight: 600;
  position: relative;
  margin-right: 15px;
  margin-bottom: 15px;
  border: 1px solid #d9dfe5;
}
.attached-document > li:before {
  position: absolute;
  top: -1px;
  right: -1px;
  font-size: 12px;
  background: #d9dfe5;
  width: 20px;
  height: 20px;
  line-height: 20px;
  text-align: center;
}
.attached-document > li img {
  max-width: 100%;
}
.attached-document > li .document-name {
  padding: 5px 10px;
  text-align: center;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  background: #f1f3f4;
}
.attached-document > li .document-name a {
  color: #2d353c;
}
.attached-document > li .document-file {
  height: 70px;
  background: none;
  overflow: hidden;
  text-align: center;
  line-height: 70px;
  font-size: 32px;
  margin: -1px;
}
</style>
