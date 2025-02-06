import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Container from "@/Components/Container";
import { Head, useForm, usePage } from "@inertiajs/react";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
import Card from "@/Components/Card";
import Checkbox from "@/Components/Checkbox";
import Swal from "sweetalert2";
export default function Edit({ auth }) {
    // destruct permissions from usepage props
    const { permissions, role } = usePage().props;

    // define state with helper inertia
    const { data, setData, post, errors } = useForm({
        name: role.name,
        selectedPermissions: role.permissions.map(
            (permission) => permission.name
        ),
        _method: "put",
    });

    // define method handleSelectedPermissions
    const handleSelectedPermissions = (e) => {
        let items = data.selectedPermissions;

        if (items.includes(e.target.value))
            items.splice(items.indexOf(e.target.value), 1);
        else items.push(e.target.value);
        setData("selectedPermissions", items);
    };

    // define method handleUpdateData
    const handleUpdatedata = async (e) => {
        e.preventDefault();

        post(route("roles.update", role.id), {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Data created successfully!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
        });
    };
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Role
                </h2>
            }
        >
            <Head title={"Edit Roles"} />
            <Container>
                <Card title={"Edit role"}>
                    <form onSubmit={handleUpdatedata}>
                        <div className="mb-4">
                            <Input
                                label={"Role Name"}
                                type={"text"}
                                value={data.name}
                                onChange={(e) =>
                                    setData("name", e.target.value)
                                }
                                errors={errors.name}
                                placeholder="Input role name.."
                            />
                        </div>
                        <div className="mb-4">
                            <div className="grid grid-cols-2 gap-4">
                                {Object.entries(permissions).map(
                                    ([group, permissionItems], i) => (
                                        <div
                                            key={i}
                                            className="p-4 bg-white rounded-lg shadow-md"
                                        >
                                            <h3 className="font-bold text-lg mb-2">
                                                {group}
                                            </h3>
                                            <div className="flex flex-wrap gap-2">
                                                {permissionItems.map(
                                                    (permission) => (
                                                        <Checkbox
                                                            label={permission}
                                                            value={permission}
                                                            onChange={
                                                                handleSelectedPermissions
                                                            }
                                                            defaultChecked={data.selectedPermissions.includes(
                                                                permission
                                                            )}
                                                            key={permission}
                                                        />
                                                    )
                                                )}
                                            </div>
                                            {errors?.selectedPermissions && (
                                                <div className="text-xs text-red-500 mt-4">
                                                    {errors.selectedPermissions}
                                                </div>
                                            )}
                                        </div>
                                    )
                                )}
                            </div>
                        </div>

                        <div className="flex items-center gap-2">
                            <Button type={"submit"} />
                            <Button
                                type={"cancel"}
                                url={route("roles.index")}
                            />
                        </div>
                    </form>
                </Card>
            </Container>
        </AuthenticatedLayout>
    );
}
