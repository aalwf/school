import React from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Container from '@/Components/Container';
import Table from '@/Components/Table';
import Button from '@/Components/Button';
import Pagination from '@/Components/Pagination';
import { Head, usePage } from '@inertiajs/react';
import Search from '@/Components/Search';
import hasAnyPermission from '@/Utils/Permissions';
export default function Index({auth}) {

    // destruct permissions props
    const { permissions,filters } = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Permissions</h2>}
        >
            <Head title={'Permissions'}/>
            <Container>
                <div className='mb-4 flex items-center justify-between gap-4'>
                    {hasAnyPermission(['permissions create']) &&
                        <Button type={'add'} url={route('permissions.create')}/>
                    }
                    <div className='w-full md:w-4/6'>
                        <Search url={route('permissions.index')} placeholder={'Search permissions data by name...'} filter={filters}/>
                    </div>
                </div>
                <Table.Card title={'Permissions'}>
                    <Table>
                        <Table.Thead>
                            <tr>
                                <Table.Th>#</Table.Th>
                                <Table.Th>Permissions Name</Table.Th>
                                <Table.Th>Action</Table.Th>
                            </tr>
                        </Table.Thead>
                        <Table.Tbody>
                            {permissions.data.map((permission, i) => (
                                <tr key={i}>
                                    <Table.Td>{++i + (permissions.current_page-1) * permissions.per_page}</Table.Td>
                                    <Table.Td>{permission.name}</Table.Td>
                                    <Table.Td>
                                        <div className='flex items-center gap-2'>
                                            {hasAnyPermission(['permissions edit']) &&
                                                <Button type={'edit'} url={route('permissions.edit', permission.id)}/>
                                            }
                                            {hasAnyPermission(['permissions delete']) &&
                                                <Button type={'delete'} url={route('permissions.destroy', permission.id)}/>
                                            }
                                        </div>
                                    </Table.Td>
                                </tr>
                            ))}
                        </Table.Tbody>
                    </Table>
                </Table.Card>
                <div className='flex items-center justify-center'>
                    {permissions.last_page !== 1 && (<Pagination links={permissions.links}/>)}
                </div>
            </Container>
        </AuthenticatedLayout>
    )
}
