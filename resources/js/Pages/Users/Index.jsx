import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Container from "@/Components/Container";
import Table from "@/Components/Table";
import Button from "@/Components/Button";
import Pagination from "@/Components/Pagination";
import { Head, usePage } from "@inertiajs/react";
import Search from "@/Components/Search";
import hasAnyPermission from "@/Utils/Permissions";
export default function Index({ auth }) {
    // destruct users props
    const { users, filters } = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Users
                </h2>
            }
        >
            <Head title={"Users"} />
            <Container>
                <div className="mb-4 flex items-center justify-between gap-4">
                    {hasAnyPermission(["users create"]) && (
                        <Button type={"add"} url={route("users.create")} />
                    )}
                    <div className="w-full md:w-4/6">
                        <Search
                            url={route("users.index")}
                            placeholder={"Search users data by name..."}
                            filter={filters}
                        />
                    </div>
                </div>
                <Table.Card title={"users"}>
                    <Table>
                        <Table.Thead>
                            <tr>
                                <Table.Th>#</Table.Th>
                                <Table.Th>User</Table.Th>
                                <Table.Th>Roles</Table.Th>
                                <Table.Th>Action</Table.Th>
                            </tr>
                        </Table.Thead>
                        <Table.Tbody>
                            {users.data.map((user, i) => (
                                <tr key={i}>
                                    <Table.Td>
                                        {++i +
                                            (users.current_page - 1) *
                                                users.per_page}
                                    </Table.Td>
                                    <Table.Td>
                                        {user.name}
                                        <div className="text-sm text-gray-400">
                                            {user.email}
                                        </div>
                                    </Table.Td>
                                    <Table.Td>
                                        <div className="flex items-center gap-2 flex-wrap">
                                            {user.roles.map((role, i) => (
                                                <span
                                                    className="inline-flex items-center px-3 py-1 rounded-full text-sm bg-sky-100 text-sky-700"
                                                    key={i}
                                                >
                                                    {role.name}
                                                </span>
                                            ))}
                                        </div>
                                    </Table.Td>
                                    <Table.Td>
                                        <div className="flex items-center gap-2">
                                            {hasAnyPermission([
                                                "users edit",
                                            ]) && (
                                                <Button
                                                    type={"edit"}
                                                    url={route(
                                                        "users.edit",
                                                        user.id
                                                    )}
                                                />
                                            )}
                                            {hasAnyPermission([
                                                "users delete",
                                            ]) && (
                                                <Button
                                                    type={"delete"}
                                                    url={route(
                                                        "users.destroy",
                                                        user.id
                                                    )}
                                                />
                                            )}
                                        </div>
                                    </Table.Td>
                                </tr>
                            ))}
                        </Table.Tbody>
                    </Table>
                </Table.Card>
                <div className="flex items-center justify-center">
                    {users.last_page !== 1 && (
                        <Pagination links={users.links} />
                    )}
                </div>
            </Container>
        </AuthenticatedLayout>
    );
}
