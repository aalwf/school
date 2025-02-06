import { Link, useForm } from "@inertiajs/react";
import {
    IconArrowBack,
    IconCheck,
    IconPencilCog,
    IconPlus,
    IconTrash,
} from "@tabler/icons-react";
import React from "react";
import Swal from "sweetalert2";
export default function Button({ type, url, className, children, ...props }) {
    const { delete: destroy } = useForm();

    const handleDeleteData = async (url) => {
        Swal.fire({
            title: "Are you sure you want to delete this?",
            text: "Data is unrecoverable!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(url);

                Swal.fire({
                    title: "Success!",
                    text: "Data deleted successfully!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });
    };

    return (
        <>
            {type === "add" && (
                <Link
                    href={url}
                    className="px-4 py-2 text-sm border rounded-lg bg-white text-gray-700 flex items-center gap-2 hover:bg-gray-100"
                >
                    <IconPlus size={18} strokeWidth={1.5} />{" "}
                    <span className="hidden lg:flex">Create New Data</span>
                </Link>
            )}
            {type === "modal" && (
                <button
                    {...props}
                    type="button"
                    className={`${className} px-4 py-2 text-sm border rounded-lg flex items-center gap-2`}
                >
                    {children}
                </button>
            )}
            {type === "submit" && (
                <button
                    type="submit"
                    className="px-4 py-2 text-sm rounded-lg border border-teal-100 bg-teal-50 text-teal-500 flex items-center gap-2 hover:bg-teal-100"
                >
                    <IconCheck size={16} strokeWidth={1.5} /> Save Data
                </button>
            )}
            {type === "cancel" && (
                <Link
                    href={url}
                    className="px-4 py-2 text-sm rounded-lg border border-rose-100 bg-rose-50 text-rose-500 flex items-center gap-2 hover:bg-rose-100"
                >
                    <IconArrowBack size={16} strokeWidth={1.5} /> Go Back
                </Link>
            )}
            {type === "edit" && (
                <Link
                    href={url}
                    className="px-4 py-2 rounded-lg bg-orange-50 text-orange-500 flex items-center gap-2 hover:bg-orange-100"
                >
                    <IconPencilCog size={16} strokeWidth={1.5} />
                </Link>
            )}
            {type === "delete" && (
                <button
                    onClick={() => handleDeleteData(url)}
                    className="px-4 py-2 rounded-lg bg-rose-50 text-rose-500 flex items-center gap-2 hover:bg-rose-100"
                >
                    <IconTrash size={18} strokeWidth={1.5} />
                </button>
            )}
        </>
    );
}
