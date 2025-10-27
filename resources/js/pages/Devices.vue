<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { devices } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from '@/components/ui/drawer'
import { Button } from '@/components/ui/button'
import Heading from '@/components/Heading.vue';
import Stats from '@/components/devices/Stats.vue';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Devices', href: devices().url },
];

const props = defineProps({
    devices: { type: Array, default: () => [] },
});

const LoadDevices = () => {
    console.log(props.devices);
};
</script>

<template>

    <Head title="Devices" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-2xl px-4 py-4">
            <h1 class="font-bold cursor-pointer" @click="LoadDevices">All Devices</h1>

            <Table>
                <TableCaption>A list of your recent devices.</TableCaption>

                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">ID</TableHead>
                        <TableHead>Serial No</TableHead>
                        <TableHead>Device</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead class="text-right">Last Seen</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <!-- ✅ If devices exist -->
                    <template v-if="props.devices?.length">
                        <TableRow v-for="device in props.devices" :key="device.id">
                            <TableCell colspan="5" class="p-0">
                                <Drawer>
                                    <DrawerTrigger class="w-full">
                                        <div
                                            class="grid grid-cols-5 text-left items-center px-4 py-2 hover:bg-muted/50 cursor-pointer">
                                            <span>{{ device.id }}</span>
                                            <span>{{ device.serial_no }}</span>
                                            <span>{{ device.name }}</span>
                                            <span>{{ device.status }}</span>
                                            <span class="text-right">{{ device.last_seen }}</span>
                                        </div>
                                    </DrawerTrigger>

                                    <DrawerContent>
                                        <DrawerHeader>
                                            <DrawerTitle>{{ device.name }}</DrawerTitle>
                                            <DrawerDescription>
                                                <Stats :stats="device.device_stats.map(s => JSON.parse(s.data))" />
                                                Device Serial: {{ device.serial_no }}
                                            </DrawerDescription>
                                        </DrawerHeader>
                                        <DrawerFooter>
                                            <DrawerClose>
                                                <Button class="w-full" variant="outline">Close</Button>
                                            </DrawerClose>
                                        </DrawerFooter>
                                    </DrawerContent>
                                </Drawer>
                            </TableCell>
                        </TableRow>
                    </template>

                    <!-- ❌ If no devices -->
                    <template v-else>
                        <TableRow>
                            <TableCell colspan="5" class="text-center py-6">
                                <Drawer>
                                    <DrawerTrigger class="w-full h-full text-center">
                                        No Devices Connected
                                    </DrawerTrigger>

                                    <DrawerContent>
                                        <DrawerHeader>
                                            <DrawerTitle>No Devices</DrawerTitle>
                                            <DrawerDescription>
                                                There are no registered devices to show.
                                            </DrawerDescription>
                                        </DrawerHeader>
                                        <DrawerFooter>
                                            <DrawerClose>
                                                <Button class=" w-full max-w-xl">
                                                    Okay
                                                </Button>
                                            </DrawerClose>
                                        </DrawerFooter>
                                    </DrawerContent>
                                </Drawer>
                            </TableCell>
                        </TableRow>
                    </template>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
