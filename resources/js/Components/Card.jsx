import React from "react";

export default function Card({ title, children, className }) {
    return (
        <>
            <div className={`p-4 rounded-t-lg border ${className} bg-white`}>
                <div className="flex items-center gap-2 font-semibold text-sm text-gray-700 capitalize">
                    {title}
                </div>
            </div>
            <div className="bg-white p-4 border border-t-0 border-b rounded-b-lg">
                {children}
            </div>
        </>
    );
}
