// components/BookModalButton.tsx
"use client";
import { useState } from "react";
import RequirementModal from "@/components/modal/TellUsModal";

export default function BookModalButton() {
  const [isModalOpen, setIsModalOpen] = useState(false);

  return (
    <div className="fixed bottom-3 right-6 z-50">
      <button
        className="bg-gradient-to-r from-purple-600 to-cyan-500 hover:from-purple-700 hover:to-cyan-600 text-white p-3 rounded-tr-2xl rounded-tl-2xl shadow-lg hover:bg-purple-800 transition-all text-sm"
        onClick={() => setIsModalOpen(true)}
      >
        Tell Us Your Requirement
      </button>
      <RequirementModal
        visible={isModalOpen}
        onClose={() => setIsModalOpen(false)}
      />
    </div>
  );
}
