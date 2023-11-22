<template>
    <form class="p-4 text-white">
        <div class="grid grid-cols-4 gap-4 mb-2">
            <label for="" class="font-bold text-right">Name:</label>
            <input type="text" class="rounded col-span-3 bg-gray-600" v-model="certificateProfile.name">
        </div>
        <div class="grid grid-cols-4 gap-2 mb-2">
            <div>
                <label for="" class="font-bold text-right">Type:</label>
            </div>
            <div>
                <label for="rootCA">Root CA</label>
                <input type="radio" name="type" id="rootCA" value="RootCA" v-model="certificateProfile.type">
            </div>
            <div>
                <label for="subCA">SubCA</label>
                <input type="radio" name="type" id="subCA" value="SubCA" v-model="certificateProfile.type">
            </div>
            <div>
                <label for="EndUser">EndUser</label>
                <input type="radio" name="type" id="EndUser" value="EndUser" v-model="certificateProfile.type">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-2">
            <label for="">KeyUsage: </label>
            <div class="col-span-3">
                <MultiSelect :options="keyUsageOptions" v-model="certificateProfile.keyUsage">

                </MultiSelect>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-2">
            <label for="">ExtendedKeyUsage: </label>
            <div class="col-span-3">
                <MultiSelect :options="extendedKeyUsageOptions" v-model="certificateProfile.extendedKeyUsageOptions">

                </MultiSelect>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-2">
            <label for="">Authority Info Access (AIA):</label>
            <div class="col-span-3">
                <input type="checkbox" v-model="certificateProfile.aia.status" value="true" class="rounded">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-2" v-if="certificateProfile.aia.status">
            <label for="">OCSP URL:</label>
            <div>
                <input type="checkbox" v-model="ocsp" value="true" class="rounded">
            </div>
            <div class="col-span-2" v-if="ocsp">
                <input type="text" class="rounded bg-gray-600 w-full" v-model="certificateProfile.aia.ocsp">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2 mb-2" v-if="certificateProfile.aia.status">
            <label for="">CA Issuers:</label>
            <div>
                <input type="checkbox" v-model="caIssuers" value="true" class="rounded">
            </div>
            <div class="col-span-2" v-if="caIssuers">
                <input type="text" class="rounded bg-gray-600 w-full" v-model="certificateProfile.aia.caIssuers">
            </div>
        </div>


    </form>
</template>

<script setup>
import { ref } from 'vue';
import MultiSelect from '../MultiSelect.vue';

const ocsp = ref(false)
const caIssuers = ref(false)


const certificateProfile = ref({
    name: '',
    type: 'RootCA',
    keyUsage: [],
    extendedKeyUsageOptions: [],
    aia: {
        status: false,
    }
})

const keyUsageOptions = {
    "digitalSignature": "Assinatura Digital",
    "nonRepudiation": "Não Repúdio",
    "keyEncipherment": "Cifragem de Chave",
    "dataEncipherment": "Cifragem de Dados",
    "keyAgreement": "Acordo de Chave",
    "keyCertSign": "Certificado de Chave",
    "cRLSign": "Lista de Revogação de Certificado",
    "encipherOnly": "Apenas Cifragem",
    "decipherOnly": "Apenas Decifragem"
}

const extendedKeyUsageOptions = {
    "serverAuth": "Autenticação de Servidor",
    "clientAuth": "Autenticação de Cliente",
    "codeSigning": "Assinatura de Código",
    "emailProtection": "Proteção de Email",
    "timeStamping": "Carimbo de Tempo",
    "OCSPSigning": "Assinatura de OCSP",
    "ipsecIKE": "IPSec IKE",
    "msCodeInd": "Indicação de Código MS",
    "msCodeCom": "Comunicação de Código MS",
    "msCTLSign": "Assinatura de CTL MS",
    "msEFS": "EFS MS"
}
</script>

<style lang="scss" scoped></style>