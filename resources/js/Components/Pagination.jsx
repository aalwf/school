import React from "react";
import { Link } from "@inertiajs/react";
import { IconChevronRight, IconChevronLeft } from "@tabler/icons-react";
export default function Pagination({ links }) {
    const style =
        "p-1 text-sm border rounded-md bg-white text-gray-500 hover:bg-gray-100";

    return (
        <>
            <ul className="mt-2 lg:mt-5 justify-end flex items-center gap-1">
                {links.map((item, i) => {
                    return item.url != null ? (
                        item.label.includes("Previous") ? (
                            <Link className={style} key={i} href={item.url}>
                                <IconChevronLeft
                                    size={"20"}
                                    strokeWidth={"1.5"}
                                />
                            </Link>
                        ) : item.label.includes("Next") ? (
                            <Link className={style} key={i} href={item.url}>
                                <IconChevronRight
                                    size={"20"}
                                    strokeWidth={"1.5"}
                                />
                            </Link>
                        ) : (
                            <Link
                                className={`px-2 py-1 text-sm border  rounded-md text-gray-500 hover:bg-gray-100 ${
                                    item.active
                                        ? "bg-white text-gray-700"
                                        : "bg-white"
                                }`}
                                key={i}
                                href={item.url}
                            >
                                {item.label}
                            </Link>
                        )
                    ) : null;
                })}
            </ul>
        </>
    );
}
