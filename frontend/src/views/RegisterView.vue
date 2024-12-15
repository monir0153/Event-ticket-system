<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { useColorMode } from '@vueuse/core'
useColorMode()
import axios from 'axios';

interface Division { id: number; name: string; }
interface District { id: number; name: string; divisionId: number; }
interface Upazilla { id: number; name: string; districtId: number; }
interface Union { id: number; name: string; upazillaId: number; }

const divisions = ref<Division[] | null>(null);
const districts = ref<District[]>([]);
const upazillas = ref<Upazilla[]>([]);
const unions = ref<Union[]>([]);

const selectedDivision = ref<string | undefined>(undefined);
const selectedDistrict = ref<string | undefined>(undefined);
const selectedUpazilla = ref<string | undefined>(undefined);

const fetchDivisions = async () => {
  try {
    const response = await axios.get('https://bdapi.vercel.app/api/v.1/division');
    divisions.value = response.data.data as Division[];
  } catch (error) {
    console.error('Error fetching divisions:', error);
  }
};
const fetchDistricts = async (divisionId: string) => {
  try {
    const response = await axios.get(`https://bdapi.vercel.app/api/v.1/district/${divisionId}`);
    districts.value = response.data.data as District[];
  } catch (error) {
    console.error('Error fetching districts:', error);
  }
};
const fetchUpazillas = async (districtId: string) => {
  try {
    const response = await axios.get(`https://bdapi.vercel.app/api/v.1/upazilla/${districtId}`);
    upazillas.value = response.data.data as Upazilla[];
  } catch (error) {
    console.error('Error fetching upazillas:', error);

  }
};
const fetchUnions = async (upazillaId: string) => {
  try {
    const response = await axios.get(`https://bdapi.vercel.app/api/v.1/union/${upazillaId}`);
    unions.value = response.data.data as Union[];
  } catch (error) {
    console.error('Error fetching unions:', error);
  }
};

watch(selectedDivision, (newVal) => {
  if (newVal) {
    fetchDistricts(newVal);
    selectedDistrict.value = undefined;
    selectedUpazilla.value = undefined;
    districts.value = [];
    upazillas.value = [];
    unions.value = [];
  }
});
watch(selectedDistrict, (newVal) => {
  if (newVal) {
    fetchUpazillas(newVal);
    selectedUpazilla.value = undefined;
    upazillas.value = [];
    unions.value = [];
  }
});
watch(selectedUpazilla, (newVal) => {
  if (newVal) {
    fetchUnions(newVal);
    unions.value = [];
  }
});
onMounted(() => { fetchDivisions(); });
</script>

<template>
  <div class="flex justify-center items-center min-h-screen py-8">
    <Card class="mx-auto max-w-md w-full">
      <CardHeader>
        <CardTitle class="text-xl">
          Registration
        </CardTitle>
        <CardDescription>
          Enter your information to create an account
        </CardDescription>
      </CardHeader>
      <CardContent>
        <div class="grid gap-4">

          <div class="grid gap-2">
            <Label for="first-name">First name</Label>
            <Input id="first-name" placeholder="Max" required />
          </div>

          <div class="grid gap-2">
            <Label for="email">Email</Label>
            <Input id="email" type="email" placeholder="m@example.com" required />
          </div>
          <div class="grid gap-2">
            <Label for="email">Phone</Label>
            <Input id="phone" type="tel" placeholder="+880187xxxxxxx" required />
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="grid gap-2">
              <Label for="password">Password</Label>
              <Input id="password" type="password" />
            </div>
            <div class="grid gap-2">
              <Label for="password">Confirm Password</Label>
              <Input id="confirmPassword" type="password" />
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4"> <Select v-model="selectedDivision">
              <SelectTrigger class="w-full">
                <SelectValue placeholder="Select a Division" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Division</SelectLabel>
                  <SelectItem v-for="division in divisions" :key="division.id" :value="division.id.toString()"> {{
                    division.name }} </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select> <Select v-model="selectedDistrict">
              <SelectTrigger class="w-full">
                <SelectValue placeholder="Select a District" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>District</SelectLabel>
                  <SelectItem v-for="district in districts" :key="district.id" :value="district.id.toString()"> {{
                    district.name }} </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select> </div>
          <div class="grid grid-cols-2 gap-4"> <Select v-model="selectedUpazilla">
              <SelectTrigger class="w-full">
                <SelectValue placeholder="Select a Upazilla" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Upazilla</SelectLabel>
                  <SelectItem v-for="upazilla in upazillas" :key="upazilla.id" :value="upazilla.id.toString()"> {{
                    upazilla.name }} </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select> <Select>
              <SelectTrigger class="w-full">
                <SelectValue placeholder="Select a Union" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Union</SelectLabel>
                  <SelectItem v-for="union in unions" :key="union.id" :value="union.id.toString()"> {{ union.name }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select> </div>
          <Button type="submit" class="w-full">
            Create an account
          </Button>
          <Button variant="outline" class="w-full">
            Sign up with GitHub
          </Button>
        </div>
        <div class="mt-4 text-center text-sm">
          Already have an account?
          <a href="#" class="underline">
            Sign in
          </a>
        </div>
      </CardContent>
    </Card>
  </div>
</template>
